<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('tracks', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('auth_id')->unsigned();
			$table->foreign('auth_id')->references('id')->on('auths');//For menu

			$table->datetime('date');

			$table->string('action', 50);
			/*
			$table->integer('action_id')->unsigned();
			$table->foreign('action_id')->references('id')->on('actions');
			*/
			$table->string('trackable_id')->nullable();
			$table->string('trackable_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `tracks` table
		Schema::drop('tracks');
	}

}
