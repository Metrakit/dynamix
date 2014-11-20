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
			
			$table->integer('auth_id')->unsigned();
			$table->foreign('auth_id')->references('id')->on('auths');

			$table->string('img')->nullable();

			$table->integer('i18n_content')->unsigned();
			$table->foreign('i18n_content')->references('id')->on('i18n');

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
