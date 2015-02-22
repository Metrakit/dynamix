<?php

class OptionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('options')->delete();

        $i18n_site_name = new I18N;
        $i18n_site_name->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $i18n_site_name->save();
        $i18n_site_name->translate('fr','Dynamix');
        $i18n_site_name->translate('en','Dynamix');

        //$i18n_site_description       = I18N::create(array())->id;
            //Translation::create(array('i18n_id' => $i18n_site_description, 'locale_id' => 'fr', 'text' => 'An awesome CMS for developer'));
            //Translation::create(array('i18n_id' => $i18n_site_description, 'locale_id' => 'en', 'text' => 'An awesome CMS for developer'));

        $i18n_blog_charset = new I18N;
        $i18n_blog_charset->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $i18n_blog_charset->save();
        $i18n_blog_charset->translate('fr','UTF-8');
        $i18n_blog_charset->translate('en','UTF-8');

        $i18n_timezone = new I18N;
        $i18n_timezone->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $i18n_timezone->save();
        $i18n_timezone->translate('fr','Europe/Paris');
        $i18n_timezone->translate('en','Europe/Paris');

        $i18n_date_format = new I18N;
        $i18n_date_format->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $i18n_date_format->save();
        $i18n_date_format->translate('fr','j F Y');
        $i18n_date_format->translate('en','j F Y');

        $i18n_time_format = new I18N;
        $i18n_time_format->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $i18n_time_format->save();
        $i18n_time_format->translate('fr','G \h i \m\i\n');
        $i18n_time_format->translate('en','G \h i \m\i\n');






        DB::table('options')->insert( array(
            array(
                'site_url'              => 'http://dynam.ix',
                'i18n_site_name'        => $i18n_site_name->id,
                //'i18n_site_description' => $i18n_site_description,

                'admin_email'           => 'd.lepaux@gmail.com',

                'mailserver_url'        => '',
                'mailserver_login'      => '',
                'mailserver_pass'       => '',
                'mailserver_port'       => '',

                'i18n_blog_charset'     => $i18n_blog_charset->id,

                'i18n_timezone'         => $i18n_timezone->id,
                'i18n_date_format'      => $i18n_date_format->id,
                'i18n_time_format'      => $i18n_time_format->id,
                
                'disqus_config'         => '',
                'analytics'             => '',

                'social_facebook'       => '',
                'social_twitter'        => '',
                'social_linkedin'       => '',
                'social_viadeo'         => '',
                'social_youtube'        => '',
                'social_google_plus'    => ''
            ))
        );



        //I18n Constant text

        $key1 = new I18N;
        $key1->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key1->key = "create";
        $key1->lang_key = "admin.i18n-constant-key.create";
        $key1->save();
        $key1->translate('fr','créer');
        $key1->translate('en','create');
        
        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "edit";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        //Comment
        //see action in public and controller...
        //lang.comment 
        //lang.button
        //lang.auth
        //lang.general
        /*
        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "comment.placeHolder";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "comment.submit";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "comment.vote_up";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "comment.vote_down";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "comment.reply";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "comment.comment";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "comment.be_the_first";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "comment.edit";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "input.filemanager_select";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "auth.you_must_be_logged";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "auth.connexion";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "button.update";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');

        $key2 = new I18N;
        $key2->i18n_type_id = I18nType::where('name','=','key')->first()->id;
        $key2->key = "input.name";
        $key2->lang_key = "admin.i18n-constant-key.edit";
        $key2->save();
        $key2->translate('fr','modifier');
        $key2->translate('en','edit');
*/

    }

}