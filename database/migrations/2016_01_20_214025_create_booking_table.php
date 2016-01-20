<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingTable extends Migration {

	public function up()
	{
		Schema::create('booking', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('flight_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('callsign', 10);
			$table->string('selcal', 4);
			$table->string('airframe', 4);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('booking');
	}
}