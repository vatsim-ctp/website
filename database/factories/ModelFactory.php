<?php

$factory->define(CTP\Models\Airfield::class, function (Faker\Generator $faker) {
    $icao = $faker->randomElement([
            'E',
            'K',
            'C',
            'L',
        ]).$faker->randomLetter().$faker->randomLetter().$faker->randomLetter();

    $csv = \League\Csv\Reader::createFromPath(database_path('airports.csv'));
    $airport = $csv
        ->addFilter(function ($row) use ($icao) {
            return strcasecmp($icao, $row[5]) == 0;
        })->fetchOne();

    return [
        'icao'      => $icao,
        'iata'      => array_get($airport, 4, substr($icao, 1)),
        'name'      => array_get($airport, 1, 'Unknown Airport '.$icao),
        'latitude'  => array_get($airport, 6, '0.0'),
        'longitude' => array_get($airport, 7, '0.0'),
        'timezone'  => array_get($airport, 11, 'UTC'),
        'type'      => $faker->randomElement(['departure', 'arrival']),
        'approved'  => 0,
    ];
});

$factory->state(CTP\Models\Airfield::class, 'approved', function (Faker\Generator $faker) {
    return [
        'approved' => 1,
    ];
});

$factory->define(CTP\Models\User::class, function (Faker\Generator $faker) {
    return [
        'id'         => $faker->numberBetween(810000, 1300000),
        'name_first' => $faker->firstName,
        'name_last'  => $faker->lastName,
        'email'      => $faker->email,
    ];
});

$factory->state(CTP\Models\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'admin' => 1,
    ];
});

$factory->define(CTP\Models\Vote::class, function (Faker\Generator $faker) {
    return [
        'airfield_id' => CTP\Models\Airfield::inRandomOrder()->first()->id,
        'user_id'  => factory(CTP\Models\User::class)->create()->id,
    ];
});

$factory->state(CTP\Models\Vote::class, 'arrival', function (Faker\Generator $faker) {
    return [
        'airfield_id' => CTP\Models\Airfield::arrival()->inRandomOrder()->first()->id,
    ];
});

$factory->state(CTP\Models\Vote::class, 'departure', function (Faker\Generator $faker) {
    return [
        'airfield_id' => CTP\Models\Airfield::departure()->inRandomOrder()->first()->id,
    ];
});
