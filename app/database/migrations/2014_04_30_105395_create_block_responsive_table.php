<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockResponsiveTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('block_responsive', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			
			$table->integer('block_id')->unsigned();
			$table->foreign('block_id')->references('id')->on('blocks');

			$table->integer('responsive_offset_id')->nullable()->unsigned()->default(null);

			$table->integer('responsive_width_id')->unsigned();
			$table->foreign('responsive_width_id')->references('id')->on('responsive_widths');

			$table->integer('responsive_trigger_id')->unsigned();
			$table->foreign('responsive_trigger_id')->references('id')->on('responsive_triggers');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `block_responsive` table
		Schema::drop('block_responsive');
	}

}
