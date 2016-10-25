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
            $table->string('aspect', 50);
            $table->string('code', 100);
            $table->enum('type', ['string', 'text', 'boolean', 'number', 'timestamp', 'date', 'time'])->default('string');
            $table->text('description');
            $table->boolean('required')->default(0);
            $table->text('value')->nullable();
            $table->text('value_default')->nullable();
            $table->text('value_options')->nullable();
            $table->timestamps();

            $table->unique('code');
        });

        DB::table('settings')->insert([
            [
                'aspect'        => 'event',
                'code'          => 'code',
                'type'          => 'string',
                'description'   => 'The code for this event.  Normally WB/EB followed by the year.  E.g. WB17',
                'required'      => '1',
                'value'         => null,
                'value_default' => null,
                'value_options' => null,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],
            [
                'aspect'        => 'event',
                'code'          => 'name',
                'type'          => 'string',
                'description'   => 'The name for this event.  E.g. Cross The Pond Westbound 2017',
                'required'      => '1',
                'value'         => null,
                'value_default' => null,
                'value_options' => null,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],
            [
                'aspect'        => 'event',
                'code'          => 'direction',
                'type'          => 'string',
                'description'   => 'The direction of the traffic during the event.',
                'required'      => '1',
                'value'         => null,
                'value_default' => null,
                'value_options' => json_encode(['eastbound', 'westbound', 'mixed']),
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],
            [
                'aspect'        => 'event',
                'code'          => 'date',
                'type'          => 'date',
                'description'   => 'The date of the event.',
                'required'      => '1',
                'value'         => null,
                'value_default' => null,
                'value_options' => null,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],
            [
                'aspect'        => 'event',
                'code'          => 'start',
                'type'          => 'time',
                'description'   => 'The official start time for the event.',
                'required'      => '1',
                'value'         => null,
                'value_default' => null,
                'value_options' => null,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],
            [
                'aspect'        => 'event',
                'code'          => 'finish',
                'type'          => 'time',
                'description'   => 'The official finish time for the event.',
                'required'      => '1',
                'value'         => null,
                'value_default' => null,
                'value_options' => null,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],
            [
                'aspect'        => 'voting',
                'code'          => 'show_results_before',
                'type'          => 'boolean',
                'description'   => 'Set to TRUE to show the total votes BEFORE a user casts their vote.',
                'required'      => 0,
                'value'         => null,
                'value_default' => 0,
                'value_options' => null,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],
            [
                'aspect'        => 'voting',
                'code'          => 'show_results_after',
                'type'          => 'boolean',
                'description'   => 'Set to TRUE to show the total votes AFTER a user casts their vote.',
                'required'      => 0,
                'value'         => null,
                'value_default' => 1,
                'value_options' => null,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],
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
