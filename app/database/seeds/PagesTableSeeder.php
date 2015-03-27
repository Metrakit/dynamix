<?php

class PagesTableSeeder extends Seeder {
        
    public function run()
    {
        DB::table('pages')->delete();

        $t_fr = 'Bonjour';
        $t_en = 'Hello';

        //page
        $name1 = new I18n;
        $name1->i18n_type_id = I18nType::where('name','=','name')->first()->id;
        $name1->save();
        $name1->translate('fr',$t_fr);
        $name1->translate('en',$t_en);
        
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
                'i18n_title'                => $title1->id,
                'i18n_url'                  => $url1->id,
                'i18n_meta_title'           => $meta_title1->id,
                'i18n_meta_description'     => $meta_description1->id,
                'structurable_id'           => 1,
                'structurable_type'         => 'Page'
            ));


        $t_fr2 = 'Aurevoir';
        $t_en2 = 'Goodbye';

        //page
        $name2 = new I18n;
        $name2->i18n_type_id = I18nType::where('name','=','name')->first()->id;
        $name2->save();
        $name2->translate('fr',$t_fr2);
        $name2->translate('en',$t_en2);

        $title2 = new I18n;
        $title2->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title2->save();
        $title2->translate('fr',$t_fr2);
        $title2->translate('en',$t_en2);
        
        $url2 = new I18n;
        $url2->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url2->save();
        $url2->translate('fr','/'.Str::slug($t_fr2));
        $url2->translate('en','/'.Str::slug($t_en2));


        $meta_title2 = new I18n;
        $meta_title2->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title2->save();
        $meta_title2->translate('fr',$t_fr2);
        $meta_title2->translate('en',$t_en2);

        $meta_description2 = new I18n;
        $meta_description2->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description2->save();
        $meta_description2->translate('fr','Description '.$t_fr2);
        $meta_description2->translate('en',$t_en2.' Description');        

        $structure2 = Structure::create(array(
                'i18n_title'                => $title2->id,
                'i18n_url'                  => $url2->id,
                'i18n_meta_title'           => $meta_title2->id,
                'i18n_meta_description'     => $meta_description2->id,
                'structurable_id'           => 2,
                'structurable_type'         => 'Page'
            ));

        $t_fr2 = 'NotAllowedAurevoir';
        $t_en2 = 'NotAllowedGoodbye';

        //page
        $name2 = new I18n;
        $name2->i18n_type_id = I18nType::where('name','=','name')->first()->id;
        $name2->save();
        $name2->translate('fr',$t_fr2);
        $name2->translate('en',$t_en2);

        $title2 = new I18n;
        $title2->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title2->save();
        $title2->translate('fr',$t_fr2);
        $title2->translate('en',$t_en2);
        
        $url2 = new I18n;
        $url2->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url2->save();
        $url2->translate('fr','/'.Str::slug($t_fr2));
        $url2->translate('en','/'.Str::slug($t_en2));


        $meta_title2 = new I18n;
        $meta_title2->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title2->save();
        $meta_title2->translate('fr',$t_fr2);
        $meta_title2->translate('en',$t_en2);

        $meta_description2 = new I18n;
        $meta_description2->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description2->save();
        $meta_description2->translate('fr','Description '.$t_fr2);
        $meta_description2->translate('en',$t_en2.' Description');        

        $structure2 = Structure::create(array(
                'i18n_title'                => $title2->id,
                'i18n_url'                  => $url2->id,
                'i18n_meta_title'           => $meta_title2->id,
                'i18n_meta_description'     => $meta_description2->id,
                'structurable_id'           => 3,
                'structurable_type'         => 'Page'
            ));

        $t_fr3 = 'NotAllowedAurevoir';
        $t_en3 = 'NotAllowedGoodbye';

        //page
        $name3 = new I18n;
        $name3->i18n_type_id = I18nType::where('name','=','name')->first()->id;
        $name3->save();
        $name3->translate('fr',$t_fr3);
        $name3->translate('en',$t_en3);

        $title3 = new I18n;
        $title3->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title3->save();
        $title3->translate('fr',$t_fr3);
        $title3->translate('en',$t_en3);
        
        $url3 = new I18n;
        $url3->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url3->save();
        $url3->translate('fr','/'.Str::slug($t_fr3));
        $url3->translate('en','/'.Str::slug($t_en3));


        $meta_title3 = new I18n;
        $meta_title3->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title3->save();
        $meta_title3->translate('fr',$t_fr3);
        $meta_title3->translate('en',$t_en3);

        $meta_description3 = new I18n;
        $meta_description3->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description3->save();
        $meta_description3->translate('fr','Description '.$t_fr3);
        $meta_description3->translate('en',$t_en3.' Description');        

        $structure2 = Structure::create(array(
                'i18n_title'                => $title3->id,
                'i18n_url'                  => $url3->id,
                'i18n_meta_title'           => $meta_title3->id,
                'i18n_meta_description'     => $meta_description3->id,
                'structurable_id'           => 4,
                'structurable_type'         => 'Page'
            ));


        DB::table('pages')->insert( array(
            array(
                'i18n_name'                 => $name1->id,
                'order'             => 1,
                'ancor'              => 'Home',
                'onepage_id'        => 1,
                'background_id'     => 1,
                'created_at'                => new DateTime,
                'updated_at'                => new DateTime
            ),
            array(
                'i18n_name'                 => $name2->id,
                'order'             => 2,
                'ancor'              => 'Content',
                'onepage_id'        => 1,
                'background_id'     => 2,
                'created_at'                => new DateTime,
                'updated_at'                => new DateTime
            ),
            array(
                'i18n_name'                 => $name2->id,
                'order'             => null,
                'ancor'              => null,
                'onepage_id'        => null,
                'background_id'     => null,
                'created_at'                => new DateTime,
                'updated_at'                => new DateTime
            ),
            array(
                'i18n_name'                 => $name3->id,
                'order'             => null,
                'ancor'              => null,
                'onepage_id'        => null,
                'background_id'     => null,
                'created_at'                => new DateTime,
                'updated_at'                => new DateTime
            ))
        );
    }

}
