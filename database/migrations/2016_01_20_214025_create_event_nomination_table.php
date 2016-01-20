<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventNominationTable extends Migration {

	public function up()
	{
		Schema::create('event_nomination', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('event_id')->unsigned();
			$table->integer('airport-id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('event_nomination');
	}
}