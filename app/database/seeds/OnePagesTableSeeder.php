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

        //Background_positions
        DB::table('background_positions')->delete();

        DB::table('background_positions')->insert( array(
            array(
                'name'       => 'relative'
            ),
            array(
                'name'       => 'fixed'
            )
        ));    


        //Backgrounds
        DB::table('backgrounds')->delete();

        DB::table('backgrounds')->insert( array(
            array(
                'url'           => 'uploads/pictures/album cute kitten/cute-kitten-2.jpg',
                'background_type_id'   => 1,
                'background_position_id'   => 1
            ),
            array(
                'url'           => 'uploads/medias/vjing.mp4',
                'background_type_id'   => 2,
                'background_position_id'   => 1
            )
        ));    


        //OnePage
        $t_fr = 'Bonjour OnePage';
        $t_en = 'Hello OnePage';
        
        $title1 = new I18n;
        $title1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title1->save();
        $title1->translate('fr',$t_fr);
        $title1->translate('en',$t_en);

        $url1 = new I18n;
        $url1->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url1->save();
        $url1->translate('fr','/');
        $url1->translate('en','/');

        $meta_title1 = new I18n;
        $meta_title1->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title1->save();
        $meta_title1->translate('fr',$t_fr);
        $meta_title1->translate('en',$t_en);

        $meta_description1 = new I18n;
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
    }

}
