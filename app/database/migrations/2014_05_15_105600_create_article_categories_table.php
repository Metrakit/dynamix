<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_categories', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_title')->unsigned();
			$table->foreign('i18n_title')->references('id')->on('i18n');

			$table->integer('i18n_url')->unsigned();
			$table->foreign('i18n_url')->references('id')->on('i18n');

			$table->integer('i18n_meta_title')->unsigned();
			$table->foreign('i18n_meta_title')->references('id')->on('i18n');

			$table->integer('i18n_meta_description')->unsigned();
			$table->foreign('i18n_meta_description')->references('id')->on('i18n');

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
		Schema::drop('article_categories');
	}

}
