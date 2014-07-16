<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('maps', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('page_id')->unsigned();
			$table->foreign('page_id')->references('id')->on('pages');

			$table->integer('view_id')->unsigned();
			$table->foreign('view_id')->references('id')->on('views');

			$table->integer('order')->unsigned();

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
		// Delete the `maps` table
		Schema::drop('maps');
	}

}
