<?php

class TagsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tags')->delete();

        $t_fr1 = 'JavaScript';
        $t_en1 = 'JavaScript';

        $title1 = new I18N;
        $title1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title1->save();
        $title1->translate('fr_FR',$t_fr1);
        $title1->translate('en_EN',$t_en1);

        $url1 = new I18N;
        $url1->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url1->save();
        $url1->translate('fr_FR','/'.Str::slug($t_fr1));
        $url1->translate('en_EN','/'.Str::slug($t_en1));

        $meta_title1 = new I18N;
        $meta_title1->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title1->save();
        $meta_title1->translate('fr_FR',$t_fr1);
        $meta_title1->translate('en_EN',$t_en1);

        $meta_description1 = new I18N;
        $meta_description1->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description1->save();
        $meta_description1->translate('fr_FR','Description du blog');
        $meta_description1->translate('en_EN','Blog description');

        $structure1 = Structure::create(array(
                'i18n_title'                => $title1->id,
                'i18n_url'                  => $url1->id,
                'i18n_meta_title'           => $meta_title1->id,
                'i18n_meta_description'     => $meta_description1->id,
                'structurable_id'           => 1,
                'structurable_type'         => 'tags'
            ));


        $t_fr2 = 'PHP';
        $t_en2 = 'PHP';

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
        $meta_description2->translate('fr_FR','Description du blog');
        $meta_description2->translate('en_EN','Blog description');

        $structure2 = Structure::create(array(
                'i18n_title'                => $title2->id,
                'i18n_url'                  => $url2->id,
                'i18n_meta_title'           => $meta_title2->id,
                'i18n_meta_description'     => $meta_description2->id,
                'structurable_id'           => 2,
                'structurable_type'         => 'tags'
            ));
            

        $t_fr3 = 'Laravel';
        $t_en3 = 'Laravel';

        $title3 = new I18N;
        $title3->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title3->save();
        $title3->translate('fr_FR',$t_fr3);
        $title3->translate('en_EN',$t_en3);

        $url3 = new I18N;
        $url3->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url3->save();
        $url3->translate('fr_FR','/'.Str::slug($t_fr3));
        $url3->translate('en_EN','/'.Str::slug($t_en3));

        $meta_title3 = new I18N;
        $meta_title3->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title3->save();
        $meta_title3->translate('fr_FR',$t_fr3);
        $meta_title3->translate('en_EN',$t_en3);

        $meta_description3 = new I18N;
        $meta_description3->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description3->save();
        $meta_description3->translate('fr_FR','Description du blog');
        $meta_description3->translate('en_EN','Blog description');

        $structure3 = Structure::create(array(
                'i18n_title'                => $title3->id,
                'i18n_url'                  => $url3->id,
                'i18n_meta_title'           => $meta_title3->id,
                'i18n_meta_description'     => $meta_description3->id,
                'structurable_id'           => 3,
                'structurable_type'         => 'tags'
            ));
            


        DB::table('tags')->insert( array(
            array(
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
