<?php

class NavigationsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('navigations')->delete();

        $title1 = new I18n;
        $title1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title1->save();
        $title1->translate('fr','Accueil');
        $title1->translate('en','Home');

/*        $title2 = new I18N;
        $title2->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title2->save();
        $title2->translate('fr','Galerie');
        $title2->translate('en','Gallery');

        $title3 = new I18N;
        $title3->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title3->save();
        $title3->translate('fr','Chaton Mignon');
        $title3->translate('en','Cute Kitten');

        $title4 = new I18N;
        $title4->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title4->save();
        $title4->translate('fr','Développement Web');
        $title4->translate('en','Web Development');

        $title5 = new I18N;
        $title5->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title5->save();
        $title5->translate('fr','Article 1');
        $title5->translate('en','Article 1');

        $title6 = new I18N;
        $title6->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title6->save();
        $title6->translate('fr','Article 2');
        $title6->translate('en','Article 2');

        $title51 = new I18N;
        $title51->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title51->save();
        $title51->translate('fr','Article 1');
        $title51->translate('en','Article 1');

        $title61 = new I18N;
        $title61->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title61->save();
        $title61->translate('fr','Article 2');
        $title61->translate('en','Article 2');*/

        $title7 = new I18n;
        $title7->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title7->save();
        $title7->translate('fr','Contact');
        $title7->translate('en','Contact');



        


        DB::table('navigations')->insert( array(
            array(
                'i18n_title'        => $title1->id,
                'parent_id'         => 0,
                'order'             => 1,
                'navigable_id'     => 1,
                'navigable_type'   => 'Page'
                ),
            /*array(
                'i18n_title'        => $title2->id,                
                'parent_id'         => 0,
                'order'             => 2,
                'navigable_id'     => 1,
                'navigable_type'   => 'Mosaic'
            ),
            array(
                'i18n_title'        => $title3->id,                
                'parent_id'         => 2,
                'order'             => 1,
                'navigable_id'     => 1,
                'navigable_type'   => 'Gallery'
            ),
            array(
                'i18n_title'        => $title4->id,                
                'parent_id'         => 0,
                'order'             => 3,
                'navigable_id'     => 1,
                'navigable_type'   => 'ArticleCategory'
            ),
            array(
                'i18n_title'        => $title5->id,                
                'parent_id'         => 4,
                'order'             => 1,
                'navigable_id'     => 2,
                'navigable_type'   => 'Article'
            ),
            array(
                'i18n_title'        => $title6->id,                
                'parent_id'         => 4,
                'order'             => 2,
                'navigable_id'     => 2,
                'navigable_type'   => 'Article'
            ),
            array(
                'i18n_title'        => $title51->id,                
                'parent_id'         => 4,
                'order'             => 3,
                'navigable_id'     => 2,
                'navigable_type'   => 'Article'
            ),
            array(
                'i18n_title'        => $title61->id,                
                'parent_id'         => 4,
                'order'             => 4,
                'navigable_id'     => 2,
                'navigable_type'   => 'Article'
                ),*/
array(
    'i18n_title'        => $title7->id,                
    'parent_id'         => 0,
    'order'             => 2,
    'navigable_id'     => 2,
    'navigable_type'   => 'Page'
    ))
);
}
}
