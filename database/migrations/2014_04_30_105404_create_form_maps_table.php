<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormMapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Comments` table
		Schema::create('form_maps', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('form_id')->unsigned()->index();
			$table->foreign('form_id')->references('id')->on('forms');

			$table->integer('input_id')->unsigned()->index();
			$table->foreign('input_id')->references('id')->on('inputs');
			
			$table->integer('order')->unsigned()->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `form_maps` table
		Schema::drop('form_maps');
	}

}
