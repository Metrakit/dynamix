<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Comments` table
		Schema::create('input_types', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->string('name');

			$table->string('rules');

			$table->string('defaultValue')->nullable();

			$table->integer('i18n_title')->unsigned()->index()->nullable();
			$table->foreign('i18n_title')->references('id')->on('i18n');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `input_types` table
		Schema::drop('input_types');
	}

}
