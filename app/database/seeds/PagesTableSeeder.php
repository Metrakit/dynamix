<?php

class PagesTableSeeder extends Seeder {
        
    public function run()
    {
        DB::table('pages')->delete();

        $t_fr = 'Bonjour';
        $t_en = 'Hello';

        //article1
        $name1 = new I18N;
        $name1->i18n_type_id = I18nType::where('name','=','name')->first()->id;
        $name1->save();
        $name1->translate('fr_FR',$t_fr);
        $name1->translate('en_EN',$t_en);
        
        $title1 = new I18N;
        $title1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title1->save();
        $title1->translate('fr_FR',$t_fr);
        $title1->translate('en_EN',$t_en);
        
        $url1 = new I18N;
        $url1->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url1->save();
        $url1->translate('fr_FR','/');
        $url1->translate('en_EN','/');

        $meta_title1 = new I18N;
        $meta_title1->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title1->save();
        $meta_title1->translate('fr_FR',$t_fr);
        $meta_title1->translate('en_EN',$t_en);

        $meta_description1 = new I18N;
        $meta_description1->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description1->save();
        $meta_description1->translate('fr_FR','Description '.$t_fr);
        $meta_description1->translate('en_EN',$t_en.' Description');

        $structure1 = Structure::create(array(
                'i18n_title'                => $title1->id,
                'i18n_url'                  => $url1->id,
                'i18n_meta_title'           => $meta_title1->id,
                'i18n_meta_description'     => $meta_description1->id,
            ));

        $structurable1 = Structurable::create(array(
                'structure_id'              => $structure1->id,
                'structurable_id'           => 1,
                'structurable_type'         => 'pages'
            ));


        $t_fr2 = 'Aurevoir';
        $t_en2 = 'Goodbye';

        //article1
        $name2 = new I18N;
        $name2->i18n_type_id = I18nType::where('name','=','name')->first()->id;
        $name2->save();
        $name2->translate('fr_FR',$t_fr2);
        $name2->translate('en_EN',$t_en2);

        $title2 = new I18N;
        $title2->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title2->save();
        $title2->translate('fr_FR',$t_fr2);
        $title2->translate('en_EN',$t_en2);
        
        $url2 = new I18N;
        $url2->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url2->save();
        $url2->translate('fr_FR','/'.Str::slug($t_fr2));
        $url2->translate('en_EN','/'.Str::slug($t_en2));


        $meta_title2 = new I18N;
        $meta_title2->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title2->save();
        $meta_title2->translate('fr_FR',$t_fr2);
        $meta_title2->translate('en_EN',$t_en2);

        $meta_description2 = new I18N;
        $meta_description2->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description2->save();
        $meta_description2->translate('fr_FR','Description '.$t_fr2);
        $meta_description2->translate('en_EN',$t_en2.' Description');        

        $structure2 = Structure::create(array(
                'i18n_title'                => $title2->id,
                'i18n_url'                  => $url2->id,
                'i18n_meta_title'           => $meta_title2->id,
                'i18n_meta_description'     => $meta_description2->id
            ));

        $structurable2 = Structurable::create(array(
                'structure_id'              => $structure2->id,
                'structurable_id'           => 2,
                'structurable_type'         => 'pages'
            ));


        DB::table('pages')->insert( array(
            array(
                'i18n_name'                 => $name1->id,
                'created_at'                => new DateTime,
                'updated_at'                => new DateTime
            ),
            array(
                'i18n_name'                 => $name2->id,
                'created_at'                => new DateTime,
                'updated_at'                => new DateTime
            ))
        );
    }

}
