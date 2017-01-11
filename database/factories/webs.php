<?php

$factory->define(App\Models\Webs\Web::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
        'email' => $faker->safeEmail,
        'domain' => $faker->domainName,
        'subdomain' => $faker->unique()->word
    ];
});
