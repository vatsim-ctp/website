<?php

$factory->define(CTP\Models\Airfield::class, function (Faker\Generator $faker) {
    $icao = $faker->randomElement([
            "E",
            "K",
            "C",
            "L"
        ]) . $faker->randomLetter() . $faker->randomLetter() . $faker->randomLetter();

    $csv = \League\Csv\Reader::createFromPath(database_path("airports.csv"));
    $airport = $csv
        ->addFilter(function ($row) use ($icao) {
            return strcasecmp($icao, $row[5]) == 0;
        })->fetchOne();

    return [
        'icao'      => $icao,
        'iata'      => array_get($airport, 4, substr($icao, 1)),
        'name'      => array_get($airport, 1, "Unknown Airport " . $icao),
        'latitude'  => array_get($airport, 6, "0.0"),
        'longitude' => array_get($airport, 7, "0.0"),
        'timezone'  => array_get($airport, 11, "UTC"),
        'type'      => $faker->randomElement(["departure", "arrival"]),
        'approved'  => 0,
    ];
});

$factory->state(CTP\Models\Airfield::class, "approved", function (Faker\Generator $faker) {
    return [
        "approved" => 1,
    ];
});

$factory->define(CTP\Models\User::class, function (Faker\Generator $faker) {
    return [
        'code'      => $faker->randomLetter . $faker->randomLetter . $faker->numberBetween(10, 20),
        "name"      => $faker->company,
        "current"     => 0,
    ];
});

$factory->define(CTP\Models\User::class, function (Faker\Generator $faker) {
    return [
        'code'      => $faker->randomLetter . $faker->randomLetter . $faker->numberBetween(10, 20),
        "name"      => $faker->company,
        "current"     => 0,
    ];
});

$factory->state(CTP\Models\User::class, "admin", function (Faker\Generator $faker) {
    return [
        "admin" => 1,
    ];
});