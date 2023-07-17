<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Expenses;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Expenses::class, function (Faker $faker) {
    return [
        'description' => $faker->word,
        'price' => rand(0, 50),
        'date' => $faker->date,
        'user_id' => factory(User::class)
    ];
});
