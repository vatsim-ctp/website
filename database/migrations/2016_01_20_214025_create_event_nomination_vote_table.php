<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventNominationVoteTable extends Migration {

	public function up()
	{
		Schema::create('event_nomination_vote', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('event_nomination_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('event_nomination_vote');
	}
}