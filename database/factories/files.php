<?php

$factory->define(App\Models\Files\File::class, function (Faker\Generator $faker) {
    $type = $faker->randomElement(['jpg', 'png', 'pdf', 'doc']);

    return [
        'web_id' => function () {
            return factory(App\Models\Webs\Web::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\Users\User::class)->create()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->optional()->paragraph,
        'file' => $faker->unique()->uuid . '.' . $type,
        'extension' => $type
    ];
});
