<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TaskAssignee::class, function (Faker $faker) {

    return [
        'assignee_id' => $faker->word,
        'assignee_type' => $faker->word,
        'assignment_id' => $faker->word
    ];
});
