<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('tags', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_name')->unsigned();
			$table->foreign('i18n_name')->references('id')->on('i18n');

			$table->integer('i18n_slug')->unsigned();
			$table->foreign('i18n_slug')->references('id')->on('i18n');

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
		// Delete the `tags` table
		Schema::drop('tags');
	}

}
