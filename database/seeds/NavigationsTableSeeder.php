<?php

use Illuminate\Database\Seeder;
use Dynamix\I18n\Models\I18n;
use Dynamix\I18n\Models\I18nType;

class NavigationsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('navigations')->delete();

        $title1 = new I18n;
        $title1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title1->save();
        $title1->translate('fr','Accueil');
        $title1->translate('en','Home');

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
            array(
                'i18n_title'        => $title7->id,                
                'parent_id'         => 0,
                'order'             => 2,
                'navigable_id'     => 2,
                'navigable_type'   => 'Page'
                ))
        );


        //Admin navigation group
        DB::table('admin_navigation_groups')->delete();

        $adminNav1 = I18n::add(array('fr'=>'Racine','en'=>'Root'), 'key', 'admin.admin_navigation_root');
        $adminNav2 = I18n::add(array('fr'=>'Gestion des contenus','en'=>'Content managment'), 'key', 'admin.admin_navigation_content');
        $adminNav3 = I18n::add(array('fr'=>'Gestion des utilisateurs','en'=>'User managment'), 'key', 'admin.admin_navigation_user');
        $adminNav4 = I18n::add(array('fr'=>'Traduction','en'=>'Translation'), 'key', 'admin.admin_navigation_translation');
        $adminNav5 = I18n::add(array('fr'=>'Option','en'=>'Option'), 'key', 'admin.admin_navigation_option');


        DB::table('admin_navigation_groups')->insert( array(
            array(
                'i18n_title'        => $adminNav1,
                'parent_id'         => 0,
                'order'             => 0,
                'deletable'     => false,
                ),
            array(
                'i18n_title'        => $adminNav2,                
                'parent_id'         => 0,
                'order'             => 1,
                'deletable'     => true,
                ),
            array(
                'i18n_title'        => $adminNav3,                
                'parent_id'         => 0,
                'order'             => 2,
                'deletable'     => true,
                ),
            array(
                'i18n_title'        => $adminNav4,                
                'parent_id'         => 0,
                'order'             => 3,
                'deletable'     => true,
                ),
            array(
                'i18n_title'        => $adminNav5,                
                'parent_id'         => 0,
                'order'             => 4,
                'deletable'     => true,
                ))
        );
    }
}
