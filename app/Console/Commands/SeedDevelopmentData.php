<?php

namespace App\Console\Commands;

use DB;
use Image;
use App\Models\Webs\Web;
use App\Models\Files\File;
use App\Models\Pages\Page;
use Illuminate\Console\Command;
use App\Models\Location\Country;
use App\Models\Partners\Partner;
use App\Models\Calendar\Calendar;
use App\Models\Widgets\{Widget, Link};
use App\Models\Users\{User, Permission};
use App\Models\Veterinarians\Veterinary;
use App\Models\Posts\{Post, Category, Comment};
use App\Models\Animals\{Animal, Media, TemporaryHome};

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
    const PAGES = 5;

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
    const CALENDAR = 50;

    /**
     * Temporary homes max to generate
     *
     * @var int
     */
    const TEMPORARY_HOMES = 20;

    /**
     * Partners max to generate
     *
     * @var int
     */
    const PARTNERS = 100;

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
        $this->call('db:seed');

        $faker = \Faker\Factory::create();

        # Generate web
        $this->info('Generating web');
        $web = new $this->web;
        $web->name = 'Protectora de Demostración';
        $web->domain = 'demo.dev';
        $web->subdomain = 'demo';
        $web->email = 'web@protecms.com';
        $web->country_id = 205;
        $web->state_id = 3288;
        $web->city_id = 38492;
        $web->installed = 1;
        $web->save();

        $web->setConfigs(config('protecms.webs.config.default'));
        $web->setConfig('animals.contact_email', $web->email);

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
            'name' => 'Admin',
            'email' => 'admin@email.com',
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
        $this->info('Generating posts categories');
        factory(Category::class, self::POSTS_CATEGORIES)->create([
            'web_id' => $web->id
        ]);

        $this->info('Generating posts');
        for ($i = 0; $i < self::POSTS; $i++) {
            factory(Post::class)->create([
                'web_id' => $web->id,
                'user_id' => $user->id,
                'category_id' => mt_rand(1, self::POSTS_CATEGORIES)
            ]);
        }

        # Generate files
        $this->info('Generating files');
        factory(File::class, self::FILES)->create([
            'web_id' => $web->id
        ]);

        # Generate animals
        $this->info('Generating animals');
        $animals = factory(Animal::class, self::ANIMALS)->create([
            'web_id' => $web->id
        ]);

        foreach ($animals as $animal) {
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
        $pages = factory(Page::class, self::PAGES)->create([
            'web_id' => $web->id,
            'user_id' => $user->id
        ]);

        # Generate temporary homes
        $this->info('Generating temporary homes');
        $temporary_homes = factory(TemporaryHome::class, self::TEMPORARY_HOMES)->create([
            'web_id' => $web->id
        ]);

        # Generate partners
        $this->info('Generating partners');
        $partners = factory(Partner::class, self::PARTNERS)->create([
            'web_id' => $web->id
        ]);

        # Generate veterinarians
        $this->info('Generating veterinarians');
        factory(Veterinary::class, self::VETERINARIANS)->create([
            'web_id' => $web->id
        ]);

        # Generate forms
        $form = $web->forms()->create([
            'email' => $web->email,
            'status' => 'published',
            'es' => [
                'user_id' => $user->id,
                'title' => 'Contacto',
                'slug' => 'contacto',
                'subject' => 'Contacto',
                'text' => '<p>Puedes contactar con nosotros mediante el siguiente formulario.</p>'
            ]
        ]);

        $fields = [
            'name' => 'text',
            'subject' => 'text',
            'email' => 'email',
            'message' => 'textarea'
        ];

        $order = 1;
        foreach ($fields as $key => $value) {
            $form->fields()->create([
                'order' => $order,
                'name' => $order,
                'type' => $value,
                'required' => 1,
                'es' => [
                    'title' => ucfirst(trans('validation.attributes.' . $key))
                ]
            ]);

            $order++;
        }

        # Generate widgets
        $this->info('Generating widgets');
        $widget = $web->widgets()->create([
            'status' => 'active',
            'side' => 'left',
            'order' => 1,
            'type' => 'menu',
            'es' => [
                'title' => 'Menú principal'
            ]
        ]);

        $widget->links()->create([
            'type' => 'link',
            'es' => [
                'title' => 'Inicio',
                'link' => '/'
            ]
        ]);

        foreach ($pages as $page) {
            if ($page->status == 'published') {
                $widget->links()->create([
                    'type' => 'link',
                    'es' => [
                        'title' => $page->title,
                        'link' => '/pagina/' . $page->id . '-' . $page->slug
                    ]
                ]);
            }
        }

        $widget->links()->create([
            'type' => 'link',
            'es' => [
                'title' => $form->title,
                'link' => '/formulario/' . $form->id . '-' . $form->slug
            ]
        ]);

        $widget = $web->widgets()->create([
            'status' => 'active',
            'side' => 'left',
            'order' => 2,
            'type' => 'menu',
            'es' => [
                'title' => 'Animales'
            ]
        ]);

        $widget->links()->create([
            'type' => 'link',
            'es' => [
                'title' => 'Todos los animales',
                'link' => '/animales'
            ]
        ]);

        $widget->links()->create([
            'type' => 'link',
            'es' => [
                'title' => 'Perros en adopción',
                'link' => '/animales?especie=perros&estado=en-adopcion'
            ]
        ]);

        $widget->links()->create([
            'type' => 'link',
            'es' => [
                'title' => 'Gatos en adopción',
                'link' => '/animales?especie=gatos&estado=en-adopcion'
            ]
        ]);

        $web->widgets()->create([
            'status' => 'active',
            'side' => 'right',
            'order' => 1,
            'type' => 'protecms',
            'file' => 'animals_search',
            'es' => [
                'title' => 'Buscador de animales'
            ]
        ]);

        $web->widgets()->create([
            'status' => 'active',
            'side' => 'right',
            'order' => 2,
            'type' => 'protecms',
            'file' => 'last_animals',
            'es' => [
                'title' => 'Últimas fichas'
            ]
        ]);

        $this->info('Seed complete.');
        $this->line('---');
        $this->info('Now you can access to website using domain or subdomain:');
        $this->table(['Domain', 'Subdomain'], [[$web->domain, $web->subdomain]]);
        $this->line('---');
        $this->info('User to login:');
        $this->table(['Email', 'Password'], [['admin@email.com', 'admin']]);
    }
}
