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
			$table->char('id',15);		
			$table->string('name_en', 80);			
			$table->string('name_locale', 80);			
			$table->text('flag');			
			$table->string('flag_w', 5);
			$table->string('flag_h', 5);

			$table->boolean('is_publish')->default(false);		
			$table->boolean('enable')->default(false);		
			$table->boolean('on_admin')->default(false);		

			$table->primary('id');
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
