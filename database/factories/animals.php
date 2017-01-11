<?php

$factory->define(App\Models\Animals\Animal::class, function (Faker\Generator $faker) {
    return [
        'web_id' => function () {
            return factory(App\Models\Webs\Web::class)->create()->id;
        },
        'name' => ucfirst($faker->word),
        'old_name' => $faker->optional->name,
        'visible' => $faker->randomElement(['hidden', 'visible']),
        'microchip' => $faker->optional->numerify('##################'),
        'kind' => $faker->randomElement(config('protecms.animals.kind')),
        'location' => $faker->randomElement(config('protecms.animals.location')),
        'gender' => $faker->randomElement(config('protecms.animals.gender')),
        'status' => $faker->randomElement(config('protecms.animals.status')),
        'birth_date' => $faker->optional->date,
        'birth_date_approximate' => $faker->boolean,
        'entry_date' => $faker->optional->date,
        'entry_date_approximate' => $faker->boolean,
        'length' => $faker->optional->numberBetween(5, 200),
        'height' => $faker->optional->numberBetween(5, 300),
        'weight' => $faker->optional->randomFloat(2, 0.5, 200),
        'es'=> [
            'breed' => $faker->optional->word,
            'text' => $faker->paragraph,
            'private_text' => $faker->optional->paragraph,
            'health_text' => $faker->optional->paragraph
        ]
    ];
});

$factory->define(App\Models\Animals\Health::class, function (Faker\Generator $faker) {
    return [
        'animal_id' => function () {
            return factory(App\Models\Animals\Animal::class)->create()->id;
        },
        'type' => $faker->randomElement(config('protecms.animals.health.type')),
        'title' => $faker->sentence,
        'medicine' => $faker->sentence,
        'text' => $faker->paragraph,
        'finish_text' => $faker->paragraph,
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'cost' => $faker->randomFloat(),
        'treatments_number' => $faker->randomNumber(),
        'treatments_each' => $faker->randomNumber(),
        'treatments_time' => $faker->randomElement(config('protecms.animals.health.treatments.time')),
    ];
});

$factory->define(App\Models\Animals\Sponsorship::class, function (Faker\Generator $faker) {
    return [
        'animal_id' => function () {
            return factory(App\Models\Animals\Animal::class)->create()->id;
        },
        'status' => $faker->randomElement(config('protecms.animals.sponsorships.status')),
        'name' => $faker->name,
        'email' => $faker->email,
        'address' => $faker->address,
        'text' => $faker->paragraph,
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'donation' => $faker->randomFloat(),
        'donation_time' => $faker->randomElement(config('protecms.animals.sponsorships.donation_time')),
        'payment_method' => $faker->randomElement(config('protecms.animals.sponsorships.payment_method')),
        'visible' => $faker->randomElement(config('protecms.animals.sponsorships.visible')),
    ];
});
