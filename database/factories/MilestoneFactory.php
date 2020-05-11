<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Milestone::class, function (Faker $faker) {

    return [
        'project_type' => $faker->word,
        'name' => $faker->word,
        'order' => $faker->randomDigitNotNull
    ];
});
