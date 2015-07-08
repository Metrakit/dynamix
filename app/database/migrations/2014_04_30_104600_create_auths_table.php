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
		//First migration file exec
		//Run i18n before
		Artisan::call('migrate', [
        	'--package'=>'dynamix/i18n'
        ]);

		// Create the `Comments` table
		Schema::create('auths', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->string('email');
			$table->string('password');
			$table->integer('order')->unsigned()->default(1);
			$table->string('remember_token')->nullable();

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
		// Delete the `auths` table
		//Schema::drop('tasks_has_auths');
		Schema::drop('auths');
	}

}
