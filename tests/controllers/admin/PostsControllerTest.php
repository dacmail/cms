<?php

use App\Models\Posts\Post;
use App\Models\Posts\Category;
use App\Models\Users\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsControllerTest extends TestCase
{
    /**
     * @test
     * @group admin/panel/posts
     */
    public function it_check_posts_list()
    {
        $posts = factory(Post::class, 10)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ]
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::posts::index')
            ->see('Listado de Artículos')
            ->seeInDatabase('posts', [
                'id' => $posts[0]->id,
            ])
            ->seeInDatabase('posts_translations', [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ]);
    }

    /**
     * @test
     * @group admin/panel/posts
     */
    public function it_unauthorized_posts_list()
    {
        factory(Post::class, 10)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ]
        ]);

        $this->actingAs(factory(User::class)->create())
            ->get(route('admin::panel::posts::index'))
            ->assertResponseStatus(401);
    }

    /**
     * @test
     * @group admin/panel/posts
     */
    public function it_check_posts_deleted_list()
    {
        factory(Post::class, 10)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ]
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::posts::deleted')
            ->see('Listado de Artículos eliminados');
    }

    /**
     * @test
     * @group admin/panel/posts
     */
    public function it_create_post()
    {
        factory(Category::class)->create();

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::posts::create')
            ->see('Publicar artículo')
            ->type('Prueba', 'es[title]')
            ->type('prueba', 'es[slug]')
            ->type('Texto', 'es[text]')
            ->select(1, 'category_id')
            ->select(1, 'es[user_id]')
            ->select('published', 'status')
            ->select('open', 'comments_status')
            ->press('Publicar')
            ->seeInDatabase('posts', [
                'id' => 1,
            ])
            ->seeInDatabase('posts_translations', [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ])
            ->seeRouteIs('admin::panel::posts::edit', ['id' => 1]);
    }

    /**
     * @group admin/panel/posts
     */
    public function test_show_post()
    {
        $post = factory(Post::class)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ]
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::posts::show', ['id' => 1])
            ->see($post->title);
    }

    /**
     * @test
     * @group admin/panel/posts
     */
    public function it_edit_post()
    {
        $post = factory(Post::class)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ]
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('posts', [
                'id' => 1
            ])
            ->seeInDatabase('posts_translations', [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ])
            ->visitRoute('admin::panel::posts::edit', ['id' => 1])
            ->type('Otro título', 'es[title]')
            ->type('otro-slug', 'es[slug]')
            ->press('Actualizar')
            ->seeInDatabase('posts_translations', [
                'title' => 'Otro título',
                'slug' => 'otro-slug',
                'user_id' => 1
            ]);
    }

    /**
     * @test
     * @group admin/panel/posts
     */
    public function it_delete_post()
    {
        $post = factory(Post::class)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ]
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('posts', [
                'id' => 1
            ])
            ->seeInDatabase('posts_translations', [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ])
            ->visitRoute('admin::panel::posts::delete', ['id' => 1])
            ->notSeeInDatabase('posts', [
                'id' => 1,
                'deleted_at' => null
            ]);
    }

    /**
     * @test
     * @group admin/panel/posts
     */
    public function it_delete_post_translation()
    {
        $post = factory(Post::class)->create([
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
            ->seeInDatabase('posts_translations', [
                'locale' => 'es',
                'text' => 'Texto',
                'user_id' => 1
            ])
            ->seeInDatabase('posts_translations', [
                'locale' => 'en',
                'text' => 'Text',
                'user_id' => 1
            ])
            ->visitRoute('admin::panel::posts::delete_translation', ['id' => 1])
            ->notSeeInDatabase('posts_translations', [
                'locale' => 'es',
                'text' => 'Texto',
                'user_id' => 1
            ]);
    }

    /**
     * @test
     * @group admin/panel/posts
     */
    public function it_restore_post()
    {
        $post = factory(Post::class)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ]
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('posts', [
                'id' => 1,
            ])
            ->seeInDatabase('posts_translations', [
                'locale' => 'es',
                'text' => 'Texto',
                'user_id' => 1
            ])
            ->visitRoute('admin::panel::posts::delete', ['id' => 1])
            ->notSeeInDatabase('posts', [
                'id' => 1,
                'deleted_at' => null
            ])
            ->visitRoute('admin::panel::posts::restore', ['id' => 1])
            ->seeInDatabase('posts', [
                'id' => 1,
                'deleted_at' => null
            ]);
    }
}
