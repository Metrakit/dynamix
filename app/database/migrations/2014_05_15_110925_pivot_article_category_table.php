<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotArticleCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_category', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('article_id')->unsigned()->index();
			$table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

			$table->integer('category_id')->unsigned()->index();
			$table->foreign('category_id')->references('id')->on('article_categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('article_category');
	}

}
