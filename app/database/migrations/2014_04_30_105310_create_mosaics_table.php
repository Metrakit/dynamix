<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMosaicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('mosaics', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();


			$table->integer('i18n_description')->unsigned();
			$table->foreign('i18n_description')->references('id')->on('i18n');

			$table->integer('structure_id')->unsigned();
			$table->foreign('structure_id')->references('id')->on('structures');

			//$table->integer('i18n_title')->unsigned();
			//$table->foreign('i18n_title')->references('id')->on('i18n');

			//$table->integer('i18n_url')->unsigned();
			//$table->foreign('i18n_url')->references('id')->on('i18n');

			//$table->integer('i18n_meta_title')->unsigned();
			//$table->foreign('i18n_meta_title')->references('id')->on('i18n');

			//$table->integer('i18n_meta_description')->unsigned();
			//$table->foreign('i18n_meta_description')->references('id')->on('i18n');

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
		// Delete the `mosaics` table
		Schema::drop('mosaics');
	}

}
