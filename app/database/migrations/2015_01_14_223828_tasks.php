<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tasks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Tasks` table
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->string('label');

			$table->string('description');
			$table->dateTime('date');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tasks_has_labels');
		Schema::dropIfExists('tasks_has_auths');
		Schema::dropIfExists('tasks');
	}

}
