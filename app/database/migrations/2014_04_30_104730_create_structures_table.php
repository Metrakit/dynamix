<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStructuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('structures', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			//For the title (h1) of the page
			$table->integer('i18n_title')->unsigned()->index()->index();
			$table->foreign('i18n_title')->references('id')->on('i18n');

			$table->integer('i18n_url')->unsigned()->index();
			$table->foreign('i18n_url')->references('id')->on('i18n');
			
			$table->integer('i18n_meta_title')->unsigned()->index();
			$table->foreign('i18n_meta_title')->references('id')->on('i18n');

			$table->integer('i18n_meta_description')->unsigned()->index();
			$table->foreign('i18n_meta_description')->references('id')->on('i18n');

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
		// Delete the `structures` table
		Schema::drop('structures');
	}

}
