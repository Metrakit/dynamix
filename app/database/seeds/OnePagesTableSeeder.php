<?php

class OnePagesTableSeeder extends Seeder {

    public function run()
    {
        //Background_types
        DB::table('background_types')->delete();

        DB::table('background_types')->insert( array(
            array(
                'name'       => 'image'
            ),
            array(
                'name'       => 'video'
            )
        ));    


        //Backgrounds
        DB::table('backgrounds')->delete();

        DB::table('backgrounds')->insert( array(
            array(
                'url'           => 'uploads\pictures\album cute kitten\cute-kitten-2.jpg',
                'background_type_id'   => 1
            )
        ));    


        //OnePage
        $t_fr = 'Bonjour OnePage';
        $t_en = 'Hello OnePage';
        
        $title1 = new I18N;
        $title1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title1->save();
        $title1->translate('fr',$t_fr);
        $title1->translate('en',$t_en);

        $url1 = new I18N;
        $url1->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url1->save();
        $url1->translate('fr','/');
        $url1->translate('en','/');

        $meta_title1 = new I18N;
        $meta_title1->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title1->save();
        $meta_title1->translate('fr',$t_fr);
        $meta_title1->translate('en',$t_en);

        $meta_description1 = new I18N;
        $meta_description1->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description1->save();
        $meta_description1->translate('fr','Description '.$t_fr);
        $meta_description1->translate('en',$t_en.' Description');

        $structure1 = Structure::create(array(
                'i18n_url'                => $url1->id,
                'i18n_title'                => $title1->id,
                'i18n_meta_title'           => $meta_title1->id,
                'i18n_meta_description'     => $meta_description1->id,
                'structurable_id'           => 1,
                'structurable_type'         => 'OnePage'
            ));

        DB::table('onepage')->delete();

        DB::table('onepage')->insert( array(
            array(),
        ));


        //OnePage Parts
        DB::table('onepage_parts')->delete();

        DB::table('onepage_parts')->insert( array(
            array(
                'order'             => 1,
                'name'              => 'Home',
                'onepage_id'        => 1,
                'background_id'     => 1,
                'page_id'      => 1
            )/*,
            array(
                'order'             => 2,
                'name'              => 'Content',
                'onepage_id'        => 1,
                'background_id'     => 1,
                'page_id'      => 2
            )*/
        ));    
    }

}