<?php

$factory->define(App\Models\Pages\Page::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    $slug = str_slug($title);

    return [
        'web_id' => function () {
            return factory(App\Models\Webs\Web::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\Users\User::class)->create()->id;
        },
        'status' => $faker->randomElement(config('protecms.pages.status')),
        'published_at' => \Carbon\Carbon::now(),
        'es' => [
            'title' => $title,
            'slug' => $slug,
            'text' => $faker->paragraph
        ]
    ];
});
