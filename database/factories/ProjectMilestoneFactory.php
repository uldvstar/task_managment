<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ProjectMilestone::class, function (Faker $faker) {

    return [
        'project_id' => $faker->word,
        'name' => $faker->word,
        'order' => $faker->randomDigitNotNull,
        'complete' => $faker->word
    ];
});
