<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {

    return [
        'commentable_id' => $faker->word,
        'commentable_type' => $faker->word,
        'user_id' => $faker->word,
        'comment' => $faker->date('Y-m-d H:i:s')
    ];
});
