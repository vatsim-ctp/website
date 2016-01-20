<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventTable extends Migration {

	public function up()
	{
		Schema::create('event', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
			$table->text('description');
			$table->enum('direction', array('E', 'W'))->nullable();
			$table->timestamp('start_at');
			$table->timestamp('finish_at');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('event');
	}
}