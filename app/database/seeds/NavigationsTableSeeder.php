<?php

class NavigationsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('navigations')->delete();

        $title1 = new I18N;
        $title1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title1->save();
        $title1->translate('fr_FR','Accueil');
        $title1->translate('en_EN','Home');

        $title2 = new I18N;
        $title2->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title2->save();
        $title2->translate('fr_FR','Galerie');
        $title2->translate('en_EN','Gallery');

        $title3 = new I18N;
        $title3->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title3->save();
        $title3->translate('fr_FR','Chaton Mignon');
        $title3->translate('en_EN','Cute Kitten');

        $title4 = new I18N;
        $title4->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title4->save();
        $title4->translate('fr_FR','Développement Web');
        $title4->translate('en_EN','Web Development');

        $title5 = new I18N;
        $title5->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title5->save();
        $title5->translate('fr_FR','Article 1');
        $title5->translate('en_EN','Article 1');

        $title6 = new I18N;
        $title6->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title6->save();
        $title6->translate('fr_FR','Article 2');
        $title6->translate('en_EN','Article 2');

        $title7 = new I18N;
        $title7->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title7->save();
        $title7->translate('fr_FR','Contact');
        $title7->translate('en_EN','Contact');



        


        DB::table('navigations')->insert( array(
            array(
                'i18n_title'        => $title1->id,
                'parent_id'         => 0,
                'order'             => 0,
                'naviggable_id'     => 1,
                'naviggable_type'   => 'pages'
            ),
            array(
                'i18n_title'        => $title2->id,                
                'parent_id'         => 0,
                'order'             => 1,
                'naviggable_id'     => 1,
                'naviggable_type'   => 'mosaics'
            ),
            array(
                'i18n_title'        => $title3->id,                
                'parent_id'         => 2,
                'order'             => 0,
                'naviggable_id'     => 1,
                'naviggable_type'   => 'galleries'
            ),
            array(
                'i18n_title'        => $title4->id,                
                'parent_id'         => 0,
                'order'             => 2,
                'naviggable_id'     => 1,
                'naviggable_type'   => 'article_categories'
            ),
            array(
                'i18n_title'        => $title5->id,                
                'parent_id'         => 4,
                'order'             => 1,
                'naviggable_id'     => 2,
                'naviggable_type'   => 'articles'
            ),
            array(
                'i18n_title'        => $title6->id,                
                'parent_id'         => 4,
                'order'             => 2,
                'naviggable_id'     => 2,
                'naviggable_type'   => 'articles'
            ),
            array(
                'i18n_title'        => $title7->id,                
                'parent_id'         => 0,
                'order'             => 3,
                'naviggable_id'     => 2,
                'naviggable_type'   => 'pages'
            ))
        );
    }
}
