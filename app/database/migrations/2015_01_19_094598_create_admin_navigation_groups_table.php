<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminNavigationGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Artisan::call('migrate', [
        	'--package'=>'dynamix/pager'
        ]);

		// Create the `modules` table
		Schema::create('admin_navigation_groups', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('i18n_title')->unsigned()->index();
			$table->foreign('i18n_title')->references('id')->on('i18n');

			$table->integer('parent_id')->unsigned();

			$table->boolean('deletable')->default(true);

			$table->integer('order')->nullable()->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `admin_navigation_groups` table
		Schema::drop('admin_navigation_groups');
	}

}
