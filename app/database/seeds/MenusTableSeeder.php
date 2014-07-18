<?php

class MenusTableSeeder extends Seeder {

    public function run()
    {
        DB::table('menus')->delete();

        $title1 = new I18N;
        $title1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title1->save();
        $title1->translate('fr','Accueil');
        $title1->translate('en','Home');


        $title2                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $title2, 'locale_id' => 'fr', 'text' => 'Page 1'));
            Translation::create(array('i18n_id' => $title2, 'locale_id' => 'en', 'text' => 'Page 1'));

        $title3                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $title3, 'locale_id' => 'fr', 'text' => 'Actualités'));
            Translation::create(array('i18n_id' => $title3, 'locale_id' => 'en', 'text' => 'News'));
        
        $title4                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $title4, 'locale_id' => 'fr', 'text' => 'Article Ex1'));
            Translation::create(array('i18n_id' => $title4, 'locale_id' => 'en', 'text' => 'Article Ex1'));

        $title5                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $title5, 'locale_id' => 'fr', 'text' => 'Article Ex2'));
            Translation::create(array('i18n_id' => $title5, 'locale_id' => 'en', 'text' => 'Article Ex2'));
        
        $title6                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $title6, 'locale_id' => 'fr', 'text' => 'Articles'));
            Translation::create(array('i18n_id' => $title6, 'locale_id' => 'en', 'text' => 'Articles'));

        $r_category         = Resource::find(1)->id;
        $r_post             = Resource::find(2)->id;
        $r_page             = Resource::find(4)->id;
        $r_linkcontainer    = Resource::find(6)->id;

        $home = Page::find(1)->id;
        $page1 = Page::find(2)->id;
        $article1 = Article::find(1)->id;
        $article2 = Article::find(2)->id;
        $category = ArticleCategory::find(1)->id;


        DB::table('menus')->insert( array(
            array(
                'i18n_title'        => $title1,
                'order'             => 1,
                'parent_id'         => 0
            ),
            array(
                'i18n_title'        => $title2,
                'order'             => 2,
                'parent_id'         => 0
            ),
            array(
                'i18n_title'        => $title3,
                'order'             => 3,
                'parent_id'         => 0
            ),
            array(
                'i18n_title'        => $title6,
                'order'             => 4,
                'parent_id'         => 0
            ),
            array(
                'i18n_title'        => $title4,
                'order'             => 1,
                'parent_id'         => 4
            ),
            array(
                'i18n_title'        => $title5,
                'order'             => 2,
                'parent_id'         => 4
            ))
        );
    }

}
