<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotArticleBlogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_blog', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('article_id')->unsigned()->index();
			$table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

			$table->integer('blog_id')->unsigned()->index();
			$table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('article_blog');
	}

}
