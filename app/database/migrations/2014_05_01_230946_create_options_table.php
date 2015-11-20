<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('options', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
			$table->string('key');
			$table->text('value')->default(null)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `options` table
		Schema::drop('options');
	}

}