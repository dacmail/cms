<?php

$factory->define(App\Models\Animals\TemporaryHome::class, function (Faker\Generator $faker) {
    return [
        'web_id' => function () {
            return factory(App\Models\Webs\Web::class)->create()->id;
        },
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'text' => $faker->optional->paragraph,
        'status'  => $faker->randomElement(config('protecms.temporaryhomes.status')),
    ];
});
