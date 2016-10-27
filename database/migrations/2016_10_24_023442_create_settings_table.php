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
            $table->enum('type', ['string', 'text', 'boolean', 'number', 'timestamp', 'date', 'time'])
                  ->default('string');
            $table->string('type_validation', 100)->default('');
            $table->text('description');
            $table->boolean('required')->default(0);
            $table->text('value')->nullable();
            $table->text('value_default')->nullable();
            $table->text('value_options')->nullable();
            $table->boolean('editable')->default(1);
            $table->boolean('hash')->default(0);
            $table->timestamps();

            $table->unique('code');
        });

        DB::table('settings')->insert([
            [
                'aspect'          => 'event',
                'code'            => 'code',
                'type'            => 'string',
                'type_validation' => 'size:4',
                'description'     => 'The code for this event.  Normally WB/EB followed by the year.  E.g. WB17',
                'required'        => '1',
                'value'           => null,
                'value_default'   => null,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'event',
                'code'            => 'name',
                'type'            => 'string',
                'type_validation' => '',
                'description'     => 'The name for this event.  E.g. Cross The Pond Westbound 2017',
                'required'        => '1',
                'value'           => null,
                'value_default'   => null,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'event',
                'code'            => 'direction',
                'type'            => 'string',
                'type_validation' => '',
                'description'     => 'The direction of the traffic during the event.',
                'required'        => '1',
                'value'           => null,
                'value_default'   => null,
                'editable'        => true,
                'hash'            => false,
                'value_options'   => json_encode(['eastbound', 'westbound', 'mixed']),
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'event',
                'code'            => 'date',
                'type'            => 'date',
                'type_validation' => 'after:now',
                'description'     => 'The date of the event.',
                'required'        => '1',
                'value'           => null,
                'value_default'   => null,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'event',
                'code'            => 'start',
                'type'            => 'time',
                'type_validation' => '',
                'description'     => 'The official start time for the event.',
                'required'        => '1',
                'value'           => null,
                'value_default'   => null,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'event',
                'code'            => 'finish',
                'type'            => 'time',
                'type_validation' => '',
                'description'     => 'The official finish time for the event.',
                'required'        => '1',
                'value'           => null,
                'value_default'   => null,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'voting',
                'code'            => 'open',
                'type'            => 'timestamp',
                'type_validation' => 'after:now',
                'description'     => 'The timestamp, in zulu, that voting should be permitted from.',
                'required'        => 0,
                'value'           => null,
                'value_default'   => null,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'voting',
                'code'            => 'close',
                'type'            => 'timestamp',
                'type_validation' => 'after:now',
                'description'     => 'The timestamp, in zulu, that voting should cease from.',
                'required'        => 0,
                'value'           => null,
                'value_default'   => null,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'voting',
                'code'            => 'departure_votes_allowed',
                'type'            => 'number',
                'type_validation' => 'min:0',
                'description'     => 'The number of departure votes a single user is permitted.',
                'required'        => 0,
                'value'           => null,
                'value_default'   => 1,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'voting',
                'code'            => 'arrival_votes_allowed',
                'type'            => 'number',
                'type_validation' => 'min:0',
                'description'     => 'The number of arrival votes a single user is permitted.',
                'required'        => 0,
                'value'           => null,
                'value_default'   => 1,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'voting',
                'code'            => 'arrivals_successful',
                'type'            => 'number',
                'type_validation' => 'min:1',
                'description'     => 'The number of arrival airfields that will be successful.',
                'required'        => 0,
                'value'           => null,
                'value_default'   => 1,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'voting',
                'code'            => 'departures_successful',
                'type'            => 'number',
                'type_validation' => 'min:1',
                'description'     => 'The number of departure airfields that will be successful.',
                'required'        => 0,
                'value'           => null,
                'value_default'   => 1,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'voting',
                'code'            => 'show_results_before',
                'type'            => 'boolean',
                'type_validation' => '',
                'description'     => 'Set to TRUE to show the total votes BEFORE a user casts their vote.',
                'required'        => 0,
                'value'           => null,
                'value_default'   => 0,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'voting',
                'code'            => 'show_results_after',
                'type'            => 'boolean',
                'type_validation' => '',
                'description'     => 'Set to TRUE to show the total votes AFTER a user casts their vote.',
                'required'        => 0,
                'value'           => null,
                'value_default'   => 1,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'voting',
                'code'            => 'publish_results',
                'type'            => 'boolean',
                'type_validation' => '',
                'description'     => 'Set to TRUE to publish the final results.',
                'required'        => 0,
                'value'           => null,
                'value_default'   => 0,
                'value_options'   => null,
                'editable'        => true,
                'hash'            => false,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
            [
                'aspect'          => 'system',
                'code'            => 'authorisation_code',
                'type'            => 'string',
                'type_validation' => '',
                'description'     => 'The authorisation code for use when performing destructive actions.',
                'required'        => 1,
                'value'           => null,
                'value_default'   => null,
                'value_options'   => null,
                'editable'        => false,
                'hash'            => true,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
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
