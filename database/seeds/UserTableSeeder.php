<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            ["id" => 980234, "name_first" => "Anthony", "name_last" => "Lawrence", "email" => "anthony.lawrence@vatsim-uk.co.uk", "admin" => 1, "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);
    }
}
