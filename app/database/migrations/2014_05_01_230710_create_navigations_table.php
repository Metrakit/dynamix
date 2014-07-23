<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('navigations', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_title')->unsigned();
			$table->foreign('i18n_title')->references('id')->on('i18n');

			$table->integer('parent_id')->unsigned();
			//$table->foreign('parent_id')->references('id')->on('navigations');

			$table->boolean('is_published')->default(true);
			
			$table->integer('order')->unsigned();

			$table->integer('naviggable_id')->unsigned();

			$table->string('naviggable_type');

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
		// Delete the `navigations` table
		Schema::drop('navigations');
	}

}
