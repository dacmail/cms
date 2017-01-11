<?php

$factory->define(App\Models\Forms\Form::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    $slug = str_slug($title);

    return [
        'web_id' => function () {
            return factory(App\Models\Webs\Web::class)->create()->id;
        },
        'email' => $faker->safeEmail,
        'status' => $faker->randomElement(config('protecms.forms.status')),
        'es' => [
            'title' => $title,
            'slug' => $slug,
            'text' => $faker->paragraph,
            'subject' => $faker->sentence,
            'user_id' => function () {
                return factory(App\Models\Users\User::class)->create()->id;
            }
        ]
    ];
});
