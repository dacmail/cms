<?php

$factory->define(App\Models\Users\User::class, function (Faker\Generator $faker) {
    return [
        'web_id' => function () {
            return App\Models\Webs\Web::first()->id;
        },
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => str_random(10),
        'remember_token' => str_random(10),
        'type' => 'user',
        'status' => $faker->randomElement(['active', 'inactive', 'banned']),
    ];
});
