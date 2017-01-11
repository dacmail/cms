<?php

$factory->define(App\Models\Partners\Partner::class, function (Faker\Generator $faker) {
    return [
        'web_id' => function () {
            return factory(App\Models\Webs\Web::class)->create()->id;
        },
        'name' => $faker->name,
        'donation' => $faker->numberBetween(0, 100),
        'payment_method' => $faker->randomElement(config('protecms.partners.payment_method')),
        'donation_time' => $faker->randomElement(config('protecms.partners.donation_time')),
        'text' => $faker->optional->paragraph
    ];
});
