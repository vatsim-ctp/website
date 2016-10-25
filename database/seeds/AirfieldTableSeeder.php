<?php

use Illuminate\Database\Seeder;

class AirfieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('airfields')->insert([
            [
                'icao'       => 'KJFK',
                'iata'       => 'JFK',
                'name'       => 'John F Kennedy Intl',
                'type'       => 'arrival',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'icao'       => 'KBOS',
                'iata'       => 'BOS',
                'name'       => 'Boston Logan Intl',
                'type'       => 'arrival',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],

            [
                'icao'       => 'KDFW',
                'iata'       => 'DFW',
                'name'       => 'Dallas Fort Worth',
                'type'       => 'arrival',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],

            [
                'icao'       => 'EGLL',
                'iata'       => 'LHR',
                'name'       => 'London Heathrow',
                'type'       => 'departure',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],

            [
                'icao'       => 'EGKK',
                'iata'       => 'LGW',
                'name'       => 'London Gatwick',
                'type'       => 'departure',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],

            [
                'icao'       => 'EHAM',
                'iata'       => 'AMS',
                'name'       => 'Amsterdam Schipol',
                'type'       => 'departure',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],

        ]);
    }
}
