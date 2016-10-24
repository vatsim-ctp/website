<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirfieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airfields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("event_id");
            $table->string("icao", 4);
            $table->string("iata", 3);
            $table->string("name", 150);
            $table->string("timezone", 100);
            $table->enum("type", ["arrival", "departure"]);
            $table->boolean("approved")->default(0);
            $table->timestamps();

            $table->unique(["event_id", "icao"]);
            $table->unique(["event_id", "iata"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airfields');
    }
}
