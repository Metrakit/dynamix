<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('urls', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_id')->unsigned();
			$table->foreign('i18n_id')->references('id')->on('i18n');

			$table->integer('resource_id')->unsigned();
			$table->foreign('resource_id')->references('id')->on('resources');

			$table->string('locale_id', 5);
			$table->foreign('locale_id')->references('id')->on('locales');

			$table->text('text');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('urls');
	}

}
