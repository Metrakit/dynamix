<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthTask extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `auth_task` table
		Schema::create('auth_task', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('tasks_id')->unsigned()->index();
			$table->foreign('tasks_id')->references('id')->on('tasks')->onDelete('cascade');

			$table->integer('auth_id')->unsigned()->index();
			$table->foreign('auth_id')->references('id')->on('auths')->onDelete('cascade');
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
