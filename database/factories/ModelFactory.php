<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Jyrone Parker',
        'email' => 'jyrone.parker@gmail.com',
        'password' => bcrypt('n1nt3nd0'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Charge::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 3000),
    ];
});
