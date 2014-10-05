<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Forms` table
		Schema::create('forms', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->enum('finish_on', array('email','database', 'model'));
			$table->enum('type', array('horizontal', 'inline', 'normal'))->default('normal');

			$table->integer('i18n_title')->unsigned()->index();
			$table->foreign('i18n_title')->references('id')->on('i18n');

			$table->integer('i18n_description')->unsigned()->index();
			$table->foreign('i18n_description')->references('id')->on('i18n');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `forms` table
		Schema::drop('forms');
	}

}
