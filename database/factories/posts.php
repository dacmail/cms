<?php

$factory->define(App\Models\Posts\Post::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    $slug = str_slug($title);

    return [
        'web_id' => function () {
            return factory(App\Models\Webs\Web::class)->create()->id;
        },
        'category_id' => function () {
            return factory(App\Models\Posts\Category::class)->create()->id;
        },
        'status' => $faker->randomElement(config('protecms.posts.status')),
        'comments_status' => $faker->randomElement(config('protecms.posts.comments_status')),
        'comments' => 0,
        'published_at' => \Carbon\Carbon::now(),
        'es' => [
            'title' => $title,
            'slug' => $slug,
            'text' => $faker->paragraph,
            'user_id' => function () {
                return factory(App\Models\Users\User::class)->create()->id;
            }
        ]
    ];
});

$factory->define(App\Models\Posts\Category::class, function (Faker\Generator $faker) {
    $title = ucfirst($faker->word);
    $slug = str_slug($title);

    return [
        'web_id' => function () {
            return factory(App\Models\Webs\Web::class)->create()->id;
        },
        'es' => [
            'title' => $title,
            'slug' => $slug,
            'text' => $faker->paragraph
        ]
    ];
});

$factory->define(App\Models\Posts\Comment::class, function (Faker\Generator $faker) {
    return [
        'post_id' => function () {
            return factory(App\Models\Posts\Post::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\Users\User::class)->create()->id;
        },
        'comment' => $faker->paragraph,
        'status' => $faker->randomElement(config('protecms.posts.comments.status'))
    ];
});
