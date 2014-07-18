<?php

class TagsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tags')->delete();

        $tag1 = new I18N;
        $tag1->i18n_type_id = I18nType::where('name','=','tag')->first()->id;
        $tag1->save();
        $tag1->translate('fr','HTML');
        $tag1->translate('en','HTML');

        $tag1_url = new I18N;
        $tag1_url->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $tag1_url->save();
        $tag1_url->translate('fr','html');
        $tag1_url->translate('en','html');


        $tag2 = new I18N;
        $tag2->i18n_type_id = I18nType::where('name','=','tag')->first()->id;
        $tag2->save();
        $tag2->translate('fr','PHP');
        $tag2->translate('en','PHP');

        $tag2_url = new I18N;
        $tag2_url->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $tag2_url->save();
        $tag2_url->translate('fr','php');
        $tag2_url->translate('en','php');


        $tag3 = new I18N;
        $tag3->i18n_type_id = I18nType::where('name','=','tag')->first()->id;
        $tag3->save();
        $tag3->translate('fr','Laravel');
        $tag3->translate('en','Laravel');

        $tag3_url = new I18N;
        $tag3_url->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $tag3_url->save();
        $tag3_url->translate('fr','laravel');
        $tag3_url->translate('en','laravel');


        DB::table('tags')->insert( array(
            array(
                'i18n_name'     => $tag1,
                'i18n_url'      => $tag1_url,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'i18n_name'     => $tag2,
                'i18n_url'      => $tag2_url,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'i18n_name'     => $tag3,
                'i18n_url'      => $tag3_url,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
