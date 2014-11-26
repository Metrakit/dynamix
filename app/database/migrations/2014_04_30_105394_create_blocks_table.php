<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('blocks', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('blockable_id')->unsigned();

			$table->string('blockable_type',45);
			
			$table->integer('page_id')->unsigned();
			$table->foreign('page_id')->references('id')->on('pages');

			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('block_types');

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
		// Delete the `blocks` table
		Schema::drop('blocks');
	}

}
