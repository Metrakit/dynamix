<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Comments` table
		Schema::create('taggables', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            
			$table->integer('tag_id')->unsigned();
			$table->foreign('tag_id')->references('id')->on('tags');
			
			$table->integer('taggable_id')->unsigned();

			$table->string('taggable_type');

			$table->index('tag_id');
			$table->index('taggable_id');
			$table->index('taggable_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `taggables` table
		Schema::drop('taggables');
	}

}
