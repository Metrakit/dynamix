<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuPageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_page', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('menu_id')->unsigned();
			$table->foreign('menu_id')->references('id')->on('menus');

			$table->integer('page_id')->unsigned();
			$table->foreign('page_id')->references('id')->on('pages');

			$table->integer('order');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `menu_page` table
		Schema::drop('menu_page');
	}

}
