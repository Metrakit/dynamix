<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackgroundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `backgrounds` table
		Schema::create('backgrounds', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->string('url');
			$table->string('background_color',30);

			$table->integer('background_type_id')->unsigned()->nullable();
			$table->foreign('background_type_id')->references('id')->on('background_types');

			$table->integer('background_position_id')->unsigned()->nullable();
			$table->foreign('background_position_id')->references('id')->on('background_positions');

			$table->nullableTimestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `backgrounds` table
		Schema::drop('backgrounds');
	}

}
