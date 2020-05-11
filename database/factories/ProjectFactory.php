<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Project::class, function (Faker $faker) {

    return [
        'type_id' => $faker->word,
        'client_id' => $faker->word,
        'reference' => $faker->word,
        'description' => $faker->word,
        'status' => $faker->word
    ];
});
