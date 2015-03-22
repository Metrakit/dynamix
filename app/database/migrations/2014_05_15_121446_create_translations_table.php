<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('translations', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_id')->unsigned()->index();
			$table->foreign('i18n_id')->references('id')->on('i18n');

			$table->string('locale_id', 5)->index();
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
		// Delete the `translations` table
		Schema::drop('translations');
	}

}
