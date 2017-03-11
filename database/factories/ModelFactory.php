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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Byte::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
        'story' => $faker->text,
        'rating' => $faker->numberBetween(0,5),
        'privacy' => $faker->numberBetween(0,2),
        'byte_date' => $faker->dateTimeBetween(
            $startDate = '-30 years',
            $endDate = 'now',
            $timezone = 'UTC'),
        'accuracy' => '11' . $faker->numberBetween(0,1) . '000',
        'timezone_id' => $faker->numberBetween(1,200),
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        //'image_id' => $faker->numberBetween(1,200), // TODO-KGW disabled until I figure out how to choose the right one
        'place_id' => $faker->numberBetween(1,200),
        'user_id' => $faker->numberBetween(1,12),
    ];
});

$factory->define(App\Place::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->city,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'province' => $faker->stateAbbr,
        'country_code' => 'CA', // TODO-KGW It would be nice to make country come from the country table
        'url_place' => $faker->url,
        'url_wikipedia' => $faker->url,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'map_zoom' => $faker->numberBetween(10,19),
        'image_id' => $faker->numberBetween(1,50),
        'timezone_id' => $faker->numberBetween(1,50), // TODO - the timzone should be aligned with actual zones
        'user_id' => $faker->numberBetween(1,12),
    ];
});