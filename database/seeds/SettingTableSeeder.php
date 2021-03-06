<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->where('aspect', '=', 'event')
          ->where('code', '=', 'code')
          ->update([
              'value'      => 'WB17',
              'updated_at' => \Carbon\Carbon::now(),
          ]);

        DB::table('settings')->where('aspect', '=', 'event')
          ->where('code', '=', 'name')
          ->update([
              'value'      => 'Cross The Pond Westbound 2017',
              'updated_at' => \Carbon\Carbon::now(),
          ]);

        DB::table('settings')->where('aspect', '=', 'event')
          ->where('code', '=', 'direction')
          ->update([
              'value'      => 'westbound',
              'updated_at' => \Carbon\Carbon::now(),
          ]);

        DB::table('settings')->where('aspect', '=', 'event')
          ->where('code', '=', 'date')
          ->update([
              'value'      => '2017-04-01',
              'updated_at' => \Carbon\Carbon::now(),
          ]);

        DB::table('settings')->where('aspect', '=', 'event')
          ->where('code', '=', 'start')
          ->update([
              'value'      => '10:00:00',
              'updated_at' => \Carbon\Carbon::now(),
          ]);

        DB::table('settings')->where('aspect', '=', 'event')
          ->where('code', '=', 'finish')
          ->update([
              'value'      => '18:00:00',
              'updated_at' => \Carbon\Carbon::now(),
          ]);

        DB::table('settings')->where('aspect', '=', 'voting')
          ->where('code', '=', 'open')
          ->update([
              'value'      => \Carbon\Carbon::now()->addDays(2)->toDateTimeString(),
              'updated_at' => \Carbon\Carbon::now(),
          ]);

        DB::table('settings')->where('aspect', '=', 'voting')
          ->where('code', '=', 'close')
          ->update([
              'value'      => \Carbon\Carbon::now()->addDays(4)->toDateTimeString(),
              'updated_at' => \Carbon\Carbon::now(),
          ]);

        DB::table('settings')->where('aspect', '=', 'system')
          ->where('code', '=', 'authorisation_code')
          ->update([
              'value'      => Hash::make('mango-orange'),
              'updated_at' => \Carbon\Carbon::now(),
          ]);
    }
}
