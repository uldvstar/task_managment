<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ModularType::class, function (Faker $faker) {

    return [
        'module_type' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'reference' => $faker->word,
        'description' => $faker->word
    ];
});
