<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStructurablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('structurables', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('structure_id')->unsigned();
			$table->foreign('structure_id')->references('id')->on('structures');

			$table->integer('structurable_id')->unsigned();

			$table->string('structurable_type');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `structurables` table
		Schema::drop('structurables');
	}

}
