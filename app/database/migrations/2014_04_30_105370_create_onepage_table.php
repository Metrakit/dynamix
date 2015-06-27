<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnepageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Onepage` table
		Schema::create('onepage', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->timestamps();
		});

		// Override pages TABLE !!!
		Schema::table('pages', function($table)
		{
			$table->boolean('show_title')->default(true);

			$table->integer('order')->unsigned()->nullable();
			
			$table->string('ancor')->nullable();

			$table->integer('background_id')->unsigned()->nullable();
			$table->foreign('background_id')->references('id')->on('backgrounds');

			$table->integer('onepage_id')->unsigned()->nullable();
			$table->foreign('onepage_id')->references('id')->on('onepage');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `onepage` table
		Schema::drop('onepage');
	}

}
