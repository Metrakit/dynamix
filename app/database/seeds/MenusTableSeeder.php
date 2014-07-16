<?php

class MenusTableSeeder extends Seeder {

    public function run()
    {
        DB::table('menus')->delete();

        $i18n_title1                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_title1, 'locale_id' => 'fr', 'text' => 'Accueil'));
            Translation::create(array('i18n_id' => $i18n_title1, 'locale_id' => 'en', 'text' => 'Home'));

        $i18n_title2                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_title2, 'locale_id' => 'fr', 'text' => 'Page 1'));
            Translation::create(array('i18n_id' => $i18n_title2, 'locale_id' => 'en', 'text' => 'Page 1'));

        $i18n_title3                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_title3, 'locale_id' => 'fr', 'text' => 'Actualités'));
            Translation::create(array('i18n_id' => $i18n_title3, 'locale_id' => 'en', 'text' => 'News'));
        
        $i18n_title4                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_title4, 'locale_id' => 'fr', 'text' => 'Article Ex1'));
            Translation::create(array('i18n_id' => $i18n_title4, 'locale_id' => 'en', 'text' => 'Article Ex1'));

        $i18n_title5                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_title5, 'locale_id' => 'fr', 'text' => 'Article Ex2'));
            Translation::create(array('i18n_id' => $i18n_title5, 'locale_id' => 'en', 'text' => 'Article Ex2'));
        
        $i18n_title6                 = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_title6, 'locale_id' => 'fr', 'text' => 'Articles'));
            Translation::create(array('i18n_id' => $i18n_title6, 'locale_id' => 'en', 'text' => 'Articles'));

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
                'i18n_title'        => $i18n_title1,
                'resource_id'       => $r_page,
                'element_id'        => $home,
                'order'             => 1,
                'parent_id'         => 0
            ),
            array(
                'i18n_title'        => $i18n_title2,
                'resource_id'       => $r_page,
                'element_id'        => $page1,
                'order'             => 2,
                'parent_id'         => 0
            ),
            array(
                'i18n_title'        => $i18n_title3,
                'resource_id'       => $r_category,
                'element_id'        => $category,
                'order'             => 3,
                'parent_id'         => 0
            ),
            array(
                'i18n_title'        => $i18n_title6,
                'resource_id'       => $r_linkcontainer,
                'element_id'        => null,
                'order'             => 4,
                'parent_id'         => 0
            ),
            array(
                'i18n_title'        => $i18n_title4,
                'resource_id'       => $r_post,
                'element_id'        => $article1,
                'order'             => 1,
                'parent_id'         => 4
            ),
            array(
                'i18n_title'        => $i18n_title5,
                'resource_id'       => $r_post,
                'element_id'        => $article2,
                'order'             => 2,
                'parent_id'         => 4
            ))
        );
    }

}
