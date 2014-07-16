<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('options', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';

            //General
			$table->string('site_url');

			$table->integer('i18n_site_name')->unsigned();
			$table->foreign('i18n_site_name')->references('id')->on('i18n');

			//$table->integer('i18n_site_description')->unsigned();
			//$table->foreign('i18n_site_description')->references('id')->on('i18n');

			//Admin
			$table->string('admin_email');

			//Confort Interface
			$table->boolean('use_smilies')->default(true);

			//Mailserver
			$table->string('mailserver_url');
			$table->string('mailserver_login');
			$table->string('mailserver_pass');
			$table->string('mailserver_port');

			//Blog
			$table->integer('default_category')->unsigned()->default(1);
			$table->integer('post_per_page')->unsigned()->default(10);
			$table->integer('i18n_blog_charset')->unsigned();
			$table->foreign('i18n_blog_charset')->references('id')->on('i18n');

			//Environment
			$table->integer('i18n_timezone')->unsigned();
			$table->foreign('i18n_timezone')->references('id')->on('i18n');
			
			$table->integer('i18n_date_format')->unsigned();
			$table->foreign('i18n_date_format')->references('id')->on('i18n');
			
			$table->integer('i18n_time_format')->unsigned();
			$table->foreign('i18n_time_format')->references('id')->on('i18n');			

			//Comment system
            $table->boolean('use_comment')->default(true);
            $table->text('disqus_config');//Disqus (comment module)

            //Analytics system
            $table->text('analytics');

            //Social data
			$table->string('social_facebook');
			$table->string('social_twitter');
			$table->string('social_linkedin');
			$table->string('social_viadeo');
			$table->string('social_youtube');
			$table->string('social_google_plus');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `options` table
		Schema::drop('options');
	}

}