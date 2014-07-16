<?php

class OptionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('options')->delete();

        $i18n_site_name              = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_site_name, 'locale_id' => 'fr', 'text' => 'Dynamix'));
            Translation::create(array('i18n_id' => $i18n_site_name, 'locale_id' => 'en', 'text' => 'Dynamix'));

        //$i18n_site_description       = I18N::create(array())->id;
            //Translation::create(array('i18n_id' => $i18n_site_description, 'locale_id' => 'fr', 'text' => 'An awesome CMS for developer'));
            //Translation::create(array('i18n_id' => $i18n_site_description, 'locale_id' => 'en', 'text' => 'An awesome CMS for developer'));

        $i18n_blog_charset            = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_blog_charset, 'locale_id' => 'fr', 'text' => 'UTF-8'));
            Translation::create(array('i18n_id' => $i18n_blog_charset, 'locale_id' => 'en', 'text' => 'UTF-8'));

        $i18n_timezone             = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_timezone, 'locale_id' => 'fr', 'text' => 'Europe/Paris'));
            Translation::create(array('i18n_id' => $i18n_timezone, 'locale_id' => 'en', 'text' => 'j F Y'));

        $i18n_date_format             = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_date_format, 'locale_id' => 'fr', 'text' => 'j F Y'));
            Translation::create(array('i18n_id' => $i18n_date_format, 'locale_id' => 'en', 'text' => 'j F Y'));

        $i18n_time_format             = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_time_format, 'locale_id' => 'fr', 'text' => 'G \h i \m\i\n'));
            Translation::create(array('i18n_id' => $i18n_time_format, 'locale_id' => 'en', 'text' => 'G \h i \m\i\n'));






        DB::table('options')->insert( array(
            array(
                'site_url'              => 'http://localhost/cms-0.0.1',
                'i18n_site_name'        => $i18n_site_name,
                //'i18n_site_description' => $i18n_site_description,

                'admin_email'           => 'd.lepaux@gmail.com',

                'mailserver_url'        => '',
                'mailserver_login'      => '',
                'mailserver_pass'       => '',
                'mailserver_port'       => '',

                'i18n_blog_charset'     => $i18n_blog_charset,

                'i18n_timezone'         => $i18n_timezone,
                'i18n_date_format'      => $i18n_date_format,
                'i18n_time_format'      => $i18n_time_format,
                
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