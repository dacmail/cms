<?php

use App\Models\Pages\Page;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PagesControllerTest extends TestCase
{
    /**
     * @group admin/panel/pages
     */
    public function test_check_pages_list()
    {
        $pages = factory(Page::class, 10)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto'
            ]
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::pages::index')
            ->see('Listado de Páginas')
            ->seeInDatabase('pages', [
                'id' => $pages[0]->id,
            ])
            ->seeInDatabase('pages_translations', [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto'
            ]);
    }

    /**
     * @group admin/panel/pages
     */
    public function test_check_pages_deleted_list()
    {
        $pages = factory(Page::class, 10)->create([
            'web_id' => 1
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::pages::deleted')
            ->see('Listado de Páginas eliminadas');
    }

    /**
     * @group admin/panel/pages
     */
    public function test_create_page()
    {
        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::pages::create')
            ->see('Publicar artículo')
            ->type('Prueba', 'es[title]')
            ->type('prueba', 'es[slug]')
            ->type('Texto', 'es[text]')
            ->select(1, 'es[user_id]')
            ->select('published', 'status')
            ->press('Publicar')
            ->seeInDatabase('pages', [
                'id' => 1,
            ])
            ->seeInDatabase('pages_translations', [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto'
            ])
            ->seeRouteIs('admin::panel::pages::edit', ['id' => 1]);
    }

    /**
     * @group admin/panel/pages
     */
    public function test_show_page()
    {
        $page = factory(Page::class)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto'
            ]
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::pages::show', ['id' => 1])
            ->see($page->title);
    }

    /**
     * @group admin/panel/pages
     */
    public function test_edit_page()
    {
        $page = factory(Page::class)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto'
            ]
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('pages', [
                'id' => 1
            ])
            ->seeInDatabase('pages_translations', [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto'
            ])
            ->visitRoute('admin::panel::pages::edit', ['id' => 1])
            ->type('Otro título', 'es[title]')
            ->type('otro-slug', 'es[slug]')
            ->press('Actualizar')
            ->seeInDatabase('pages_translations', [
                'title' => 'Otro título',
                'slug' => 'otro-slug'
            ]);
    }

    /**
     * @group admin/panel/pages
     */
    public function test_delete_page()
    {
        $page = factory(Page::class)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto'
            ]
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('pages', [
                'id' => 1
            ])
            ->seeInDatabase('pages_translations', [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto'
            ])
            ->visitRoute('admin::panel::pages::delete', ['id' => 1])
            ->notSeeInDatabase('pages', [
                'id' => 1,
                'deleted_at' => null
            ]);
    }

    /**
     * @group admin/panel/pages
     */
    public function test_delete_page_translation()
    {
        $page = factory(Page::class)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ],
            'en' => [
                'title' => 'Test',
                'slug' => 'test',
                'text' => 'Text',
                'user_id' => 1
            ]
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('pages_translations', [
                'locale' => 'es',
                'text' => 'Texto'
            ])
            ->seeInDatabase('pages_translations', [
                'locale' => 'en',
                'text' => 'Text'
            ])
            ->visitRoute('admin::panel::pages::delete_translation', ['id' => 1])
            ->notSeeInDatabase('pages_translations', [
                'locale' => 'es',
                'text' => 'Texto'
            ]);
    }

    /**
     * @group admin/panel/pages
     */
    public function test_restore_page()
    {
        $page = factory(Page::class)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ]
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('pages', [
                'id' => 1,
            ])
            ->seeInDatabase('pages_translations', [
                'locale' => 'es',
                'text' => 'Texto'
            ])
            ->visitRoute('admin::panel::pages::delete', ['id' => 1])
            ->notSeeInDatabase('pages', [
                'id' => 1,
                'deleted_at' => null
            ])
            ->visitRoute('admin::panel::pages::restore', ['id' => 1])
            ->seeInDatabase('pages', [
                'id' => 1,
                'deleted_at' => null
            ]);
    }
}
