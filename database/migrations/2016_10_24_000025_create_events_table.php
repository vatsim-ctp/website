<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string("code", 4);
            $table->string("name", 100);
            $table->timestamp("application_start")->nullable();
            $table->timestamp("application_finish")->nullable();
            $table->timestamp("voting_start")->nullable();
            $table->timestamp("voting_finish")->nullable();
            $table->timestamp("event_start")->nullable();
            $table->timestamp("event_finish")->nullable();
            $table->boolean("current")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
