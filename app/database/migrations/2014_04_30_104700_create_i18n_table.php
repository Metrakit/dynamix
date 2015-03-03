<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateI18nTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i18n', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_type_id')->unsigned();
			$table->foreign('i18n_type_id')->references('id')->on('i18n_types');
			
			$table->string('key')->nullable()->default(null);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `i18n` table
		Schema::drop('i18n');
	}

}
