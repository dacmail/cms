<?php

$factory->define(App\Models\Widgets\Widget::class, function (Faker\Generator $faker) {
    return [
        'web_id' => function () {
            return App\Models\Webs\Web::first()->id;
        },
        'file' => $faker->name,
        'status' => $faker->name,
        'side' => $faker->name,
        'order' => $faker->name,
        'type' => $faker->name,
        'title' => $faker->name,
        'content' => $faker->name,
    ];
});
