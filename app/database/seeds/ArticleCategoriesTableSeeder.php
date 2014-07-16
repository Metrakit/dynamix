<?php

class ArticleCategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('article_categories')->delete();

        $i18n_title 				= I18N::create(array())->id;
        	Translation::create(array('i18n_id' => $i18n_title, 'locale_id' => 'fr', 'text' => 'Automobile'));
        	Translation::create(array('i18n_id' => $i18n_title, 'locale_id' => 'en', 'text' => 'Automotors'));
		$i18n_url 				= I18N::create(array())->id;
			Urls::create(array('i18n_id' => $i18n_url, 'resource_id' => 1, 'locale_id' => 'fr', 'text' => '/automobile'));
			Urls::create(array('i18n_id' => $i18n_url, 'resource_id' => 1, 'locale_id' => 'en', 'text' => '/automotors'));
		$i18n_meta_title 		= I18N::create(array())->id;
			Translation::create(array('i18n_id' => $i18n_meta_title, 'locale_id' => 'fr', 'text' => 'Automobile'));
			Translation::create(array('i18n_id' => $i18n_meta_title, 'locale_id' => 'en', 'text' => 'Automotors'));
		$i18n_meta_description 	= I18N::create(array())->id;
			Translation::create(array('i18n_id' => $i18n_meta_description, 'locale_id' => 'fr', 'text' => 'Automobile description'));
			Translation::create(array('i18n_id' => $i18n_meta_description, 'locale_id' => 'en', 'text' => 'Automotors description'));

        DB::table('article_categories')->insert( array(
            array(
                'i18n_title'				=> $i18n_title,
				'i18n_url'					=> $i18n_url,
				'i18n_meta_title'			=> $i18n_meta_title,
				'i18n_meta_description'		=> $i18n_meta_description
            ))
        );
    }

}
