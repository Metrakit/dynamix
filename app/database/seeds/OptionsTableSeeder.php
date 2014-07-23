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
    }

}