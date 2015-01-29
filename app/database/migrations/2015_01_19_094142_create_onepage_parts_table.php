<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnepagePartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Onepage` table
		Schema::create('onepage_parts', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('order')->unsigned();
			
			$table->string('name');

			$table->integer('background_id')->unsigned();
			$table->foreign('background_id')->references('id')->on('backgrounds');

			$table->integer('onepage_id')->unsigned();
			$table->foreign('onepage_id')->references('id')->on('onepage');

			$table->integer('page_id')->unsigned();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `onepage_parts` table
		Schema::drop('onepage_parts');
	}

}
