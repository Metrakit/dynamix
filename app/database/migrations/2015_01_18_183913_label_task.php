<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LabelTask extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `label_task` table
		Schema::create('label_task', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('tasks_id')->unsigned()->index();
			$table->foreign('tasks_id')->references('id')->on('tasks')->onDelete('cascade');

			$table->integer('labels_id')->unsigned()->index();
			$table->foreign('labels_id')->references('id')->on('labels')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
