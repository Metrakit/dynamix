<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Comments` table
		Schema::create('permissions', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('role_id')->unsigned();
			$table->foreign('role_id')->references('id')->on('roles');

			$table->enum('type',array('allow','deny'));

			$table->integer('action_id')->unsigned();
			$table->foreign('action_id')->references('id')->on('actions');

			$table->integer('resource_id')->unsigned();
			$table->foreign('resource_id')->references('id')->on('resources');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `permissions` table
		Schema::drop('permissions');
	}

}
