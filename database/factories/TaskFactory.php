<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Task::class, function (Faker $faker) {

    return [
        'milestone_id' => $faker->word,
        'type_id' => $faker->word,
        'title' => $faker->word,
        'description' => $faker->word,
        'status' => $faker->word,
        'active' => $faker->word
    ];
});
