<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuMosaicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_mosaic', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('menu_id')->unsigned();
			$table->foreign('menu_id')->references('id')->on('menus');

			$table->integer('mosaic_id')->unsigned();
			$table->foreign('mosaic_id')->references('id')->on('mosaics');

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
		// Delete the `menu_mosaic` table
		Schema::drop('menu_mosaic');
	}

}
