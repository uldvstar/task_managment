<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Client::class, function (Faker $faker) {

    return [
        'type_id' => $faker->word,
        'marking' => $faker->word,
        'name' => $faker->word,
        'email' => $faker->word,
        'wechat_id' => $faker->word
    ];
});
