<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Comments` table
		Schema::create('users', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('pseudo');
			$table->string('email');
			$table->string('password');
			$table->string('remember_token')->nullable();
			$table->dateTime('last_visit_at');
			$table->string('favorite_lang');
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
		// Delete the `users` table
		Schema::drop('users');
	}

}
