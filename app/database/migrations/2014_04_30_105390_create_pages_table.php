<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('pages', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('i18n_name')->unsigned()->index();
			$table->foreign('i18n_name')->references('id')->on('i18n');

			$table->boolean('is_published')->default(false);
			$table->boolean('is_commentable')->default(false);
			$table->boolean('deletable')->default(true);

			//OnePage part
			$table->integer('order')->unsigned()->nullable();
			
			$table->string('ancor')->nullable();

			$table->integer('background_id')->unsigned()->nullable();
			$table->foreign('background_id')->references('id')->on('backgrounds');

			$table->integer('onepage_id')->unsigned()->nullable();
			$table->foreign('onepage_id')->references('id')->on('onepage');

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
		// Delete the `pages` table
		Schema::drop('pages');
	}

}
