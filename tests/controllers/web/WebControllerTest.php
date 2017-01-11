<?php

use Carbon\Carbon;
use App\Models\Posts\Post;
use App\Models\Animals\Animal;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WebControllerTest extends TestCase
{
    /**
     * @group web
     */
    public function test_check_home_page()
    {
        $this->visitRoute('web::index')
            ->seeStatusCode(200);
    }

    /**
     * @group web
     */
    public function test_check_single_post_page()
    {
        $post = factory(Post::class)->create([
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(1),
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1
            ]
        ]);

        $this->visitRoute('web::posts::show', ['id' => $post->id, 'slug' => $post->slug])
            ->see($post->title)
            ->seeStatusCode(200);
    }
}
