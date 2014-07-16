<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `articles` table
		Schema::create('articles', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');

			$table->integer('i18n_title')->unsigned();
			$table->foreign('i18n_title')->references('id')->on('i18n');

			$table->integer('i18n_url')->unsigned();
			$table->foreign('i18n_url')->references('id')->on('i18n');

			$table->string('img');

			$table->integer('i18n_content')->unsigned();
			$table->foreign('i18n_content')->references('id')->on('i18n');

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
		// Delete the `articles` table
		Schema::drop('articles');
	}

}
