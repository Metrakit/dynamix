<?php

class TagsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tags')->delete();

        $i18n_name1                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_name1, 'locale_id' => 'fr', 'text' => 'TestTagFR'));
            Translation::create(array('i18n_id' => $i18n_name1, 'locale_id' => 'en', 'text' => 'TestTagEN'));
        
        $i18n_slug1                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_slug1, 'locale_id' => 'fr', 'text' => Str::slug('TestTagFR')));
            Translation::create(array('i18n_id' => $i18n_slug1, 'locale_id' => 'en', 'text' => Str::slug('TestTagEN')));


        $i18n_name2                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_name2, 'locale_id' => 'fr', 'text' => 'Test2TagFR'));
            Translation::create(array('i18n_id' => $i18n_name2, 'locale_id' => 'en', 'text' => 'Test2TagEn'));
        
        $i18n_slug2                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_slug2, 'locale_id' => 'fr', 'text' => Str::slug('Test2TagFR')));
            Translation::create(array('i18n_id' => $i18n_slug2, 'locale_id' => 'en', 'text' => Str::slug('Test2TagEN')));



        DB::table('tags')->insert( array(
            array(
                'i18n_name'     => $i18n_name1,
                'i18n_slug'     => $i18n_slug1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'i18n_name'     => $i18n_name2,
                'i18n_slug'     => $i18n_slug2,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
