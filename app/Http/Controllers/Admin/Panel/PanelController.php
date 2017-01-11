<?php

namespace App\Http\Controllers\Admin\Panel;

use App\Models\Posts\Post;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use App\Models\Animals\Animal;
use App\Models\Partners\Partner;
use App\Models\Veterinarians\Veterinary;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use App\Http\Controllers\Admin\BaseAdminController;

class PanelController extends BaseAdminController
{
    protected $animal;
    protected $post;
    protected $user;
    protected $partner;
    protected $veterinary;

    public function __construct(Animal $animal, Post $post, User $user, Partner $partner, Veterinary $veterinary)
    {
        parent::__construct();

        $this->animal = $animal;
        $this->post = $post;
        $this->user = $user;
        $this->partner = $partner;
        $this->veterinary = $veterinary;
    }

    public function index(Request $request)
    {
        $animals = $this->animal->orderBy('created_at', 'DESC')->take(5)->get();
        $posts = $this->post->with(['translations', 'category.translations'])->orderBy('created_at', 'DESC')->take(5)->get();
        $users = $this->web->users()->orderBy('created_at', 'DESC')->take(5)->get();

        return view('admin.panel.index', compact('animals', 'posts', 'users'));
    }

    public function stats(Request $request)
    {
        # Pageviews Analytics
        if (app('App\Models\Webs\Web')->subdomain === 'admin' && ! app('App\Models\Webs\Web')->getConfig('web')) {
            $response = Analytics::performQuery(
                Period::days(30),
                'ga:pageviews,ga:users',
                [
                    'dimensions' => 'ga:date,ga:hostname',
                    'sort' => '-ga:date'
                ]
            );
        } else {
            $response = Analytics::performQuery(
                Period::days(30),
                'ga:pageviews,ga:users',
                [
                    'dimensions' => 'ga:date,ga:hostname',
                    'sort' => '-ga:date',
                    'filters' => 'ga:hostname=='.$this->web->getDomainOrSubdomain()
                ]
            );
        }

        $google_analytics = collect($response['rows'] ?? [])
            ->map(function (array $row) {
                return [
                    'date' => Carbon::createFromFormat('Ymd', $row[0]),
                    'hostname' => $row[1],
                    'pageViews' => (int) $row[2],
                    'visitors' => (int) $row[3],
                ];
            });

        $analytics = [];
        for ($i = 0; $i < 30; $i++) {
            $now = Carbon::now()->subDays($i)->format('Y-m-d');
            $analytics['categories'][] = $now;

            foreach ($google_analytics as $analytic) {
                if ($analytic['date']->format('Y-m-d') === $now) {
                    $analytics['pageviews'][$now] = $analytic['pageViews'];
                    $analytics['users'][$now] = $analytic['visitors'];
                }
            }

            if (! isset($analytics['pageviews'][$now])) {
                $analytics['pageviews'][$now] = 0;
            }

            if (! isset($analytics['users'][$now])) {
                $analytics['users'][$now] = 0;
            }
        }

        $analytics['categories'] = array_reverse($analytics['categories']);
        ksort($analytics['pageviews']);
        ksort($analytics['users']);

        # Animals
        $animals = [];
        $animals['total'] = $this->animal->where('status', '!=', 'dead')->count();

        # Gender
        $animals['male'] = $this->animal->where('status', '!=', 'dead')->where('gender', 'male')->count();
        $animals['female'] = $this->animal->where('status', '!=', 'dead')->where('gender', 'female')->count();
        $animals['unknown'] = $this->animal->where('status', '!=', 'dead')->where('gender', 'unknown')->count();

        # Status
        $animals['adoption'] = $this->animal->where('status', '!=', 'dead')->where('status', 'adoption')->count();
        $animals['adopted'] = $this->animal->where('status', '!=', 'dead')->where('status', 'adopted')->count();
        $animals['reserved'] = $this->animal->where('status', '!=', 'dead')->where('status', 'reserved')->count();
        $animals['unavailable'] = $this->animal->where('status', '!=', 'dead')->where('status', 'unavailable')->count();
        $animals['found'] = $this->animal->where('status', '!=', 'dead')->where('status', 'found')->count();
        $animals['lost'] = $this->animal->where('status', '!=', 'dead')->where('status', 'lost')->count();

        # Location
        $animals['shelter'] = $this->animal->where('status', '!=', 'dead')->where('location', 'shelter')->count();
        $animals['temporary_home'] = $this->animal->where('status', '!=', 'dead')->where('location', 'temporary_home')->count();
        $animals['animal_home'] = $this->animal->where('status', '!=', 'dead')->where('location', 'animal_home')->count();
        $animals['street'] = $this->animal->where('status', '!=', 'dead')->where('location', 'street')->count();
        $animals['unknown'] = $this->animal->where('status', '!=', 'dead')->where('location', 'unknown')->count();
        $animals['family'] = $this->animal->where('status', '!=', 'dead')->where('location', 'family')->count();

        # Kind
        $animals['dog'] = $this->animal->where('status', '!=', 'dead')->where('kind', 'dog')->count();
        $animals['cat'] = $this->animal->where('status', '!=', 'dead')->where('kind', 'cat')->count();
        $animals['horse'] = $this->animal->where('status', '!=', 'dead')->where('kind', 'horse')->count();
        $animals['rodent'] = $this->animal->where('status', '!=', 'dead')->where('kind', 'rodent')->count();
        $animals['bird'] = $this->animal->where('status', '!=', 'dead')->where('kind', 'bird')->count();
        $animals['reptile'] = $this->animal->where('status', '!=', 'dead')->where('kind', 'reptile')->count();
        $animals['other'] = $this->animal->where('status', '!=', 'dead')->where('kind', 'other')->count();

        # Users
        $users['users'] = $this->web->users()->where('type', 'user')->count();
        $users['volunteers'] = $this->web->users()->where('type', 'volunteer')->count();
        $users['admins'] = $this->web->users()->where('type', 'admin')->count();

        # Partners
        $partners['partners'] = $this->partner->count();

        # Posts
        $posts['posts'] = $this->post->count();

        # Pages
        $pages['pages'] = $this->post->count();

        # Forms
        $forms['forms'] = $this->post->count();

        # Files
        $files['files'] = $this->post->count();

        # Veterinarians
        $veterinarians['veterinarians'] = $this->veterinary->count();

        $data = [
            'analytics' => $analytics,
            'animals_total' => $animals['total'],
            'animals_male' => $animals['male'],
            'animals_female' => $animals['female'],
            'animals_unknown' => $animals['unknown'],
            'animals_adoption' => $animals['adoption'],
            'animals_adopted' => $animals['adopted'],
            'animals_reserved' => $animals['reserved'],
            'animals_unavailable' => $animals['unavailable'],
            'animals_found' => $animals['found'],
            'animals_lost' => $animals['lost'],
            'animals_shelter' => $animals['shelter'],
            'animals_temporary_home' => $animals['temporary_home'],
            'animals_animal_home' => $animals['animal_home'],
            'animals_street' => $animals['street'],
            'animals_family' => $animals['family'],
            'animals_dog' => $animals['dog'],
            'animals_cat' => $animals['cat'],
            'animals_horse' => $animals['horse'],
            'animals_rodent' => $animals['rodent'],
            'animals_bird' => $animals['bird'],
            'animals_reptile' => $animals['reptile'],
            'animals_other' => $animals['other'],
            'users' => $users['users'],
            'volunteers' => $users['volunteers'],
            'admins' => $users['admins'],
            'partners' => $partners['partners'],
            'posts' => $posts['posts'],
            'pages' => $pages['pages'],
            'forms' => $forms['forms'],
            'files' => $files['files'],
            'veterinarians' => $veterinarians['veterinarians']
        ];

        return view('admin.panel.stats', compact('data'));
    }
}
