<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_title')->unsigned();
			$table->foreign('i18n_title')->references('id')->on('i18n');

			$table->integer('resource_id')->unsigned();
			$table->foreign('resource_id')->references('id')->on('resources');

			$table->integer('element_id')->unsigned()->nullable();//refer to post, page or category to get the url etc..

			$table->integer('order');

			$table->integer('parent_id')->unsigned();
			//$table->foreign('parent_id')->references('id')->on('menus');

			$table->boolean('is_published')->default(true);

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
		// Delete the `menus` table
		Schema::drop('menus');
	}

}
