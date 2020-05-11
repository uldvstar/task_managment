<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TimeTracker::class, function (Faker $faker) {

    return [
        'trackable_id' => $faker->word,
        'trackable_type' => $faker->word,
        'user_id' => $faker->word,
        'time_start' => $faker->date('Y-m-d H:i:s'),
        'time_end' => $faker->date('Y-m-d H:i:s')
    ];
});
