<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 100);
            $table->text('description');
            $table->boolean('value')->default(0);
            $table->timestamps();

            $table->unique('code');
        });

        DB::table('settings')->insert([
            ['code' => 'voting.show_results_before', 'description' => 'Set to TRUE to show the total votes BEFORE a user casts their vote.', 'value' => 0],
            ['code' => 'voting.show_results_after', 'description' => 'Set to TRUE to show the total votes AFTER a user casts their vote.', 'value' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
