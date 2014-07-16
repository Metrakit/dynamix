<?php

class BlogsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('blogs')->delete();

        //blog /
        $i18n_title              = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_title, 'locale_id' => 'fr', 'text' => 'Blog à Patrick'));
            Translation::create(array('i18n_id' => $i18n_title, 'locale_id' => 'en', 'text' => 'Patrick\'s blog'));
        $i18n_url               = I18N::create(array())->id;
            Urls::create(array('i18n_id' => $i18n_url, 'resource_id' => 4, 'locale_id' => 'fr', 'text' => '/'.Str::slug('Blog à Patrick')));
            Urls::create(array('i18n_id' => $i18n_url, 'resource_id' => 4, 'locale_id' => 'en', 'text' => '/'.Str::slug('Patrick\'s blog')));
        $i18n_meta_title        = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_meta_title, 'locale_id' => 'fr', 'text' => 'Blog à Patrick'));
            Translation::create(array('i18n_id' => $i18n_meta_title, 'locale_id' => 'en', 'text' => 'Patrick\'s blog'));
        $i18n_meta_description  = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_meta_description, 'locale_id' => 'fr', 'text' => 'Description du blog'));
            Translation::create(array('i18n_id' => $i18n_meta_description, 'locale_id' => 'en', 'text' => 'Blog description'));


        DB::table('blogs')->insert( array(
            array(
                'i18n_title'                => $i18n_title,
                'i18n_url'                  => $i18n_url,
                'i18n_meta_title'           => $i18n_meta_title,
                'i18n_meta_description'     => $i18n_meta_description,
                'created_at'                => new DateTime,
                'updated_at'                => new DateTime
            ))
        );
    }

}
