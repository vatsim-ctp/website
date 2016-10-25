<?php

use Illuminate\Database\Seeder;

class VoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CTP\Models\Vote::class, 400)->create();
    }
}
