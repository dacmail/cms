<?php

$factory->define(App\Models\Calendar\Calendar::class, function (Faker\Generator $faker) {
    $start = $faker->dateTimeBetween('-2 month', '+2 month');

    return [
        'web_id' => function () {
            return App\Models\Webs\Web::first()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->optional->paragraph,
        'start_date' => $start,
        'end_date' => date('Y-m-d H:i:s', strtotime($start->format('Y-m-d H:i:s')) + 60*60),
        'all_day' => $faker->boolean(5),
        'type' => $faker->randomElement(config('protecms.calendar.type')),
    ];
});
