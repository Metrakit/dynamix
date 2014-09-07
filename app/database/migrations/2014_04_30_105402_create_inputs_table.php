<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `inputs` table
		Schema::create('inputs', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('view_id')->unsigned()->index();
			$table->foreign('view_id')->references('id')->on('views');

			$table->integer('i18n_placeholder')->unsigned()->index();
			$table->foreign('i18n_placeholder')->references('id')->on('i18n');

			$table->integer('i18n_helper')->unsigned()->index();
			$table->foreign('i18n_helper')->references('id')->on('i18n');

			$table->integer('type_id')->unsigned()->index();
			$table->foreign('type_id')->references('id')->on('input_types');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `inputs` table
		Schema::drop('inputs');
	}

}
