<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlightTable extends Migration {

	public function up()
	{
		Schema::create('flight', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('event_id')->unsigned();
			$table->integer('departure_id')->unsigned();
			$table->integer('arrival_id')->unsigned();
			$table->integer('alternate_id')->unsigned();
			$table->smallInteger('flight_level_min');
			$table->smallInteger('flight_level_max');
			$table->boolean('suggested_concored');
			$table->time('etot')->nullable();
			$table->time('eobt')->nullable();
			$table->timestamp('released_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('flight');
	}
}