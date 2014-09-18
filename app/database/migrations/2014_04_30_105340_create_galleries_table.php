<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('galleries', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_description')->unsigned();
			$table->foreign('i18n_description')->references('id')->on('i18n');

			$table->integer('cover_image_id')->unsigned();
			$table->foreign('cover_image_id')->references('id')->on('files');

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
		// Delete the `galleries` table
		Schema::drop('galleries');
	}

}
