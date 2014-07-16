<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `roles` table
		Schema::create('roles', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->string('name', 45);

			$table->integer('inherited_role_id')->nullable()->unsigned();
			$table->foreign('inherited_role_id')->references('id')->on('roles');
			
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
		// Delete the `roles` table
		Schema::drop('roles');
	}

}
