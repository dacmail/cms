<?php

$factory->define(App\Models\Veterinarians\Veterinary::class, function (Faker\Generator $faker) {
    return [
        'web_id' => function () {
            return App\Models\Webs\Web::first()->id;
        },
        'name' => $faker->company,
        'contact_name' => $faker->name,
        'email' => $faker->optional->safeEmail,
        'phone' => $faker->optional->e164PhoneNumber,
        'emergency_phone' => $faker->optional->e164PhoneNumber,
        'address' => $faker->optional->address,
        'text' => $faker->optional->paragraph,
        'status' => $faker->randomElement(['active', 'inactive']),
    ];
});
