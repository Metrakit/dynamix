<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Comments` table
		Schema::create('auths', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('auth_id')->unsigned();

			$table->string('email');
			$table->string('password');
			$table->integer('order')->unsigned()->default(1);
			$table->string('remember_token')->nullable();

			$table->nullableTimestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `auths` table
		//Schema::drop('tasks_has_auths');
		Schema::drop('auths');
	}

}
