<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slides', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_title')->unsigned();
			$table->foreign('i18n_title')->references('id')->on('i18n');

			$table->integer('i18n_description')->unsigned();
			$table->foreign('i18n_description')->references('id')->on('i18n');

			$table->integer('slider_id')->unsigned();
			$table->foreign('slider_id')->references('id')->on('sliders');

			$table->integer('image_id')->unsigned();
			$table->foreign('image_id')->references('id')->on('images');

			$table->string('background_color',6)->nullable();//refer to post, page or category to get the url etc..

			$table->integer('order')->unsigned();

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
		// Delete the `slides` table
		Schema::drop('slides');
	}

}
