<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'mobile_number' => $faker->phoneNumber,
        'south_african_id_number' => $faker->word,
        'language' => \Illuminate\Support\Arr::random(config('web.languages')),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'birth_date' => now(),
        'password' => 'password',
        'remember_token' => Str::random(10),
    ];
});
