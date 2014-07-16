<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('trackings', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');//For menu

			$table->datetime('date');

			$table->integer('action_id')->unsigned();
			$table->foreign('action_id')->references('id')->on('actions');

			$table->integer('resource_id')->unsigned();
			$table->foreign('resource_id')->references('id')->on('resources');

			$table->integer('element_id')->nullable()->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `trackings` table
		Schema::drop('trackings');
	}

}
