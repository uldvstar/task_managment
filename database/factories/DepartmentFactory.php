<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Department::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->word,
        'head_id' => $faker->word
    ];
});
