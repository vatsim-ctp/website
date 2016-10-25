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
            $table->string('icao', 4);
            $table->string('iata', 3)->nullable();
            $table->string('name', 150);
            $table->enum('type', ['arrival', 'departure']);
            $table->double('latitude', 10, 7)->default(0);
            $table->double('longitude', 10, 7)->default(0);
            $table->string('timezone', 100)->nullable();
            $table->boolean('approved')->default(0);
            $table->timestamps();

            $table->unique('icao');
            $table->unique('iata');
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
