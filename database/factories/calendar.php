<?php

$factory->define(App\Models\Calendar\Calendar::class, function (Faker\Generator $faker) {
    $start = $faker->dateTimeBetween('-2 month', '+2 month');
    $end = $start;
    date_add($end, date_interval_create_from_date_string('1 hour'));

    return [
        'web_id' => function () {
            return factory(App\Models\Webs\Web::class)->create()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->optional->paragraph,
        'start_date' => $start->format('Y-m-d H:i:s'),
        'end_date' => $end->format('Y-m-d H:i:s'),
        'all_day' => $faker->boolean(5),
        'type' => $faker->randomElement(config('protecms.calendar.type')),
    ];
});
