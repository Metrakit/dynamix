<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Comments` table
		Schema::create('comments', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->text('text');
			$table->integer('user_id')->unsigned();

			$table->string('locale_id',5)->nullable();

			$table->integer('is_published')->default(true);

			$table->integer('commentable_id');
			$table->string('commentable_type');

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
		// Delete the `comments` table
		Schema::drop('comments');
	}


}
