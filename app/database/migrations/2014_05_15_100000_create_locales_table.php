<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locales', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->string('id',5)->primary();		
			$table->string('name', 50);			
			$table->boolean('enable')->default(true);		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `locale` table
		Schema::drop('locales');
	}

}
