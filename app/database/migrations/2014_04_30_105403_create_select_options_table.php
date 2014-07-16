<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Comments` table
		Schema::create('select_options', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('input_id')->unsigned()->index();
			$table->foreign('input_id')->references('id')->on('inputs');

			$table->integer('i18n_key')->unsigned()->index();
			$table->foreign('i18n_key')->references('id')->on('i18n');

			$table->integer('i18n_value')->unsigned()->index();
			$table->foreign('i18n_value')->references('id')->on('i18n');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `select_options` table
		Schema::drop('select_options');
	}

}
