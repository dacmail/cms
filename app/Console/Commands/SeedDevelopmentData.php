<?php

namespace App\Console\Commands;

use DB;
use Image;
use App\Models\Webs\Web;
use App\Models\Files\File;
use App\Models\Users\User;
use App\Models\Pages\Page;
use Illuminate\Console\Command;
use App\Models\Location\Country;
use App\Models\Calendar\Calendar;
use App\Models\Widgets\Widget;
use App\Models\Widgets\Link;
use App\Models\Animals\Animal;
use App\Models\Animals\Media;
use App\Models\Veterinarians\Veterinary;
use App\Models\Posts\Post;
use App\Models\Posts\Category;
use App\Models\Posts\Comment;

class SeedDevelopmentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'protecms:seeddevdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed fake data to development';

    /**
     * Users to generate
     *
     * @var int
     */
    const USERS = 20;

    /**
     * Posts categories to generate
     *
     * @var int
     */
    const POSTS_CATEGORIES = 4;

    /**
     * Posts to generate
     *
     * @var int
     */
    const POSTS = 20;

    /**
     * Posts comments max to generate
     *
     * @var int
     */
    const POSTS_COMMENTS = 20;

    /**
     * Files max to generate
     *
     * @var int
     */
    const FILES = 20;

    /**
     * Animals max to generate
     *
     * @var int
     */
    const ANIMALS = 20;

    /**
     * Animals photos max to generate
     *
     * @var int
     */
    const ANIMALS_PHOTOS = 6;

    /**
     * Pages max to generate
     *
     * @var int
     */
    const PAGES = 20;

    /**
     * Veterinarians max to generate
     *
     * @var int
     */
    const VETERINARIANS = 5;

    /**
     * Calendar max to generate
     *
     * @var int
     */
    const CALENDAR = 200;

    /**
     * Create a new command instance.
     *
     * @param Web $web
     * @param User $user
     */
    public function __construct(Web $web, User $user)
    {
        parent::__construct();

        $this->web = $web;
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('migrate:refresh');

        $faker = \Faker\Factory::create();

        # Import locations
        $files = ['countries.sql', 'states.sql', 'cities.sql'];

        foreach ($files as $file) {
            $sql = file_get_contents(database_path('seeds/dumps/' . $file));
            $statements = array_filter(array_map('trim', explode(';', $sql)));

            foreach ($statements as $stmt) {
                DB::statement($stmt);
            }
        }

        # Generate web
        $this->info('Generating web');
        $web = new $this->web;
        $web->name = 'Protectora de Demostración';
        $web->domain = null;
        $web->subdomain = 'demo';
        $web->email = 'web@protecms.com';
        $web->country_id = 205;
        $web->state_id = 3288;
        $web->city_id = 38492;
        $web->installed = 1;
        $web->save();

        $web->setConfigs([
            'theme' => 'default',
            'lang' => 'es',
            'langs' => 'es,en',
            'themes.default.color' => '#25c2e6'
        ]);

        removeFolder($web->getStorageFolder());

        # Generate calendar
        $this->info('Generating calendar');
        factory(Calendar::class, self::CALENDAR)->create([
            'web_id' => $web->id
        ]);

        # Generate users
        $this->info('Generating users');
        $user = factory(User::class)->create([
            'web_id' => $web->id,
            'name' => 'Jaime Sares',
            'email' => 'jaimesares@gmail.com',
            'password' => 'admin',
            'type' => 'admin',
            'country_id' => 205,
            'state_id' => 3288,
            'city_id' => 38492,
        ]);

        factory(User::class, self::USERS)->create([
            'web_id' => $web->id
        ]);

        # Generate posts
        $this->info('Generating posts');
        factory(Category::class, self::POSTS_CATEGORIES)->create([
            'web_id' => $web->id
        ]);

        factory(Post::class, self::POSTS)->create([
            'web_id' => $web->id,
            'user_id' => $user->id
        ]);

        factory(Comment::class, self::POSTS_COMMENTS)->create([
        ]);

        # Generate files
        $this->info('Generating files');
        factory(File::class, self::FILES)->create([
            'web_id' => $web->id
        ]);

        # Generate animals
        $this->info('Generating animals');
        factory(Animal::class, self::ANIMALS)->create([
            'web_id' => $web->id
        ]);

        foreach (Animal::all() as $animal) {
            $path = storage_path('app/web/' . $web->id . '/animals/' . $animal->id . '/photos');

            foreach (range(0, rand(0, self::ANIMALS_PHOTOS)) as $i) {
                checkFolder($path);
                $image = $faker->image($path, 800, 800, 'animals', false);

                if ($image) {
                    if (is_file($path . '/' . $image)) {
                        Image::make($path . '/' . $image)->fit(600, 600, function ($constraint) {
                            $constraint->upsize();
                        })->save($path . '/thumbnail-m-' . $image);

                        Image::make($path . '/' . $image)->fit(200, 200, function ($constraint) {
                            $constraint->upsize();
                        })->save($path . '/thumbnail-m-' . $image);
                    }

                    $animal->media()->create([
                        'animal_id' => $animal->id,
                        'type' => 'photo',
                        'file' => $image,
                        'main' => 0
                    ]);
                }
            }
        }

        # Generate pages
        $this->info('Generating pages');
        factory(Page::class, self::PAGES)->create([
            'web_id' => $web->id,
            'user_id' => $user->id
        ]);

        # Generate veterinarians
        $this->info('Generating veterinarians');
        factory(Veterinary::class, self::VETERINARIANS)->create([
            'web_id' => $web->id
        ]);

        # Generate widgets
        $this->info('Generating widgets');
        $widgets = [
            [
                'web_id' => $web->id,
                'status' => 'active',
                'side' => 'left',
                'order' => 1,
                'type' => 'menu',
                'es' => [
                    'title' => 'Menú principal'
                ]
            ],
            [
                'web_id' => $web->id,
                'status' => 'active',
                'side' => 'left',
                'order' => 1,
                'type' => 'menu',
                'es' => [
                    'title' => 'Otro menú'
                ]
            ],
            [
                'web_id' => $web->id,
                'status' => 'active',
                'side' => 'right',
                'order' => 1,
                'type' => 'menu',
                'es' => [
                    'title' => 'Otro menú'
                ]
            ],
            [
                'web_id' => $web->id,
                'status' => 'active',
                'side' => 'right',
                'order' => 1,
                'type' => 'custom',
                'es' => [
                    'title' => 'Otro menú',
                    'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eos totam atque, tenetur doloribus. Optio neque sint corporis? Nam tempore officia vero laudantium animi libero quis eum error ipsam facilis.</p>'
                ]
            ],
        ];

        $pages_to_widget = Page::take(5)->get();
        $links = [
            1 => [
                [
                    'widget_id' => 1,
                    'type' => 'link',
                    'es' => [
                        'title' => 'Inicio',
                        'link' => '/',
                    ]
                ]
            ],
            2 => [
                [
                    'widget_id' => 1,
                    'type' => 'link',
                    'es' => [
                        'title' => 'Inicio',
                        'link' => '/',
                    ]
                ]
            ],
            3 => [
                [
                    'widget_id' => 1,
                    'type' => 'link',
                    'es' => [
                        'title' => 'Inicio',
                        'link' => '/',
                    ]
                ]
            ],
        ];

        foreach ($pages_to_widget as $page) {
            $links[1][] = [
                'widget_id' => 1,
                'type' => 'link',
                'es' => [
                    'title' => $page->title,
                    'link' => '/' . $page->id . '-' . $page->slug,
                ]
            ];

            $links[2][] = [
                'widget_id' => 1,
                'type' => 'link',
                'es' => [
                    'title' => $page->title,
                    'link' => '/' . $page->id . '-' . $page->slug,
                ]
            ];

            $links[3][] = [
                'widget_id' => 1,
                'type' => 'link',
                'es' => [
                    'title' => $page->title,
                    'link' => '/' . $page->id . '-' . $page->slug,
                ]
            ];
        }

        foreach ($widgets as $widget) {
            $w = Widget::create($widget);

            if (isset($links[$w->id])) {
                foreach ($links[$w->id] as $link) {
                    $w->links()->create($link);
                }
            }
        }

        $this->info('Seed complete.');
    }
}
