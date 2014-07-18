<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sliders', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_title')->unsigned();
			$table->foreign('i18n_title')->references('id')->on('i18n');

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
		// Delete the `sliders` table
		Schema::drop('sliders');
	}

}
