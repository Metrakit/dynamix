<?php

class ArticlesTableSeeder extends Seeder {
    
    protected $content = 'In mea autem etiam menandri, quot elitr vim ei, eos semper disputationi id? Per facer appetere eu, duo et animal maiestatis. Omnesque invidunt mnesarchum ex mel, vis no case senserit dissentias. Te mei minimum singulis inimicus, ne labores accusam necessitatibus vel, vivendo nominavi ne sed. Posidonium scriptorem consequuntur cum ex? Posse fabulas iudicabit in nec, eos cu electram forensibus, pro ei commodo tractatos reformidans. Qui eu lorem augue alterum, eos in facilis pericula mediocritatem?

    Est hinc legimus oporteat in. Sit ei melius delicatissimi. Duo ex qualisque adolescens! Pri cu solum aeque. Aperiri docendi vituperatoribus has ea!

    Sed ut ludus perfecto sensibus, no mea iisque facilisi. Choro tation melius et mea, ne vis nisl insolens. Vero autem scriptorem cu qui? Errem dolores no nam, mea tritani platonem id! At nec tantas consul, vis mundi petentium elaboraret ex, mel appareat maiestatis at.

    Sed et eros concludaturque. Mel ne aperiam comprehensam! Ornatus delicatissimi eam ex, sea an quidam tritani placerat? Ad eius iriure consequat eam, mazim temporibus conclusionemque eum ex.

    Te amet sumo usu, ne autem impetus scripserit duo, ius ei mutat labore inciderint! Id nulla comprehensam his? Ut eam deleniti argumentum, eam appellantur definitionem ad. Pro et purto partem mucius!

    Cu liber primis sed, esse evertitur vis ad. Ne graeco maiorum mea! In eos nostro docendi conclusionemque. Ne sit audire blandit tractatos? An nec dicam causae meliore, pro tamquam offendit efficiendi ut.

    Te dicta sadipscing nam, denique albucius conclusionemque ne usu, mea eu euripidis philosophia! Qui at vivendo efficiendi! Vim ex delenit blandit oportere, in iriure placerat cum. Te cum meis altera, ius ex quis veri.

    Mutat propriae eu has, mel ne veri bonorum tincidunt. Per noluisse sensibus honestatis ut, stet singulis ea eam, his dicunt vivendum mediocrem ei. Ei usu mutat efficiantur, eum verear aperiam definitiones an! Simul dicam instructior ius ei. Cu ius facer doming cotidieque! Quot principes eu his, usu vero dicat an.

    Ex dicta perpetua qui, pericula intellegam scripserit id vel. Id fabulas ornatus necessitatibus mel. Prompta dolorem appetere ea has. Vel ad expetendis instructior!

    Te his dolorem adversarium? Pri eu rebum viris, tation molestie id pri. Mel ei stet inermis dissentias. Sed ea dolorum detracto vituperata. Possit oportere similique cu nec, ridens animal quo ex?';


    public function run()
    {
        DB::table('articles')->delete();

        $user_id = User::first()->id;

        //article1
        $i18n_title              = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_title, 'locale_id' => 'fr', 'text' => 'Exemple article 1'));
            Translation::create(array('i18n_id' => $i18n_title, 'locale_id' => 'en', 'text' => 'article exemple 1'));
        $i18n_url               = I18N::create(array())->id;
            Urls::create(array('i18n_id' => $i18n_url, 'resource_id' => 2, 'locale_id' => 'fr', 'text' => '/exemple-article-1'));
            Urls::create(array('i18n_id' => $i18n_url, 'resource_id' => 2, 'locale_id' => 'en', 'text' => '/article-exemple-1'));
        $i18n_content            = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_content, 'locale_id' => 'fr', 'text' => $this->content));
            Translation::create(array('i18n_id' => $i18n_content, 'locale_id' => 'en', 'text' => $this->content));
        $i18n_meta_title        = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_meta_title, 'locale_id' => 'fr', 'text' => 'Exemple article 1'));
            Translation::create(array('i18n_id' => $i18n_meta_title, 'locale_id' => 'en', 'text' => 'article exemple 1'));
        $i18n_meta_description  = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_meta_description, 'locale_id' => 'fr', 'text' => 'Exemple article 1 description'));
            Translation::create(array('i18n_id' => $i18n_meta_description, 'locale_id' => 'en', 'text' => 'article exemple 1 description'));
        
        //article2
        $i18n_title2              = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_title2, 'locale_id' => 'fr', 'text' => 'Exemple article 2'));
            Translation::create(array('i18n_id' => $i18n_title2, 'locale_id' => 'en', 'text' => 'article exemple 2'));
        $i18n_url2               = I18N::create(array())->id;
            Urls::create(array('i18n_id' => $i18n_url2, 'resource_id' => 2, 'locale_id' => 'fr', 'text' => '/exemple-article-2'));
            Urls::create(array('i18n_id' => $i18n_url2, 'resource_id' => 2, 'locale_id' => 'en', 'text' => '/article-exemple-2'));
        $i18n_content2            = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_content2, 'locale_id' => 'fr', 'text' => $this->content));
            Translation::create(array('i18n_id' => $i18n_content2, 'locale_id' => 'en', 'text' => $this->content));
        $i18n_meta_title2        = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_meta_title2, 'locale_id' => 'fr', 'text' => 'Exemple article 2'));
            Translation::create(array('i18n_id' => $i18n_meta_title2, 'locale_id' => 'en', 'text' => 'article exemple 2'));
        $i18n_meta_description2  = I18N::create(array())->id;
            Translation::create(array('i18n_id' => $i18n_meta_description2, 'locale_id' => 'fr', 'text' => 'Exemple article 2 description'));
            Translation::create(array('i18n_id' => $i18n_meta_description2, 'locale_id' => 'en', 'text' => 'article exemple 2 description'));

        DB::table('articles')->insert( array(
            array(
                'user_id'               => $user_id,
                'i18n_title'            => $i18n_title,
                'i18n_url'              => $i18n_url,
                'img'                   => '',
                'i18n_content'          => $i18n_content,
                'i18n_meta_title'       => $i18n_meta_title,
                'i18n_meta_description' => $i18n_meta_description,
                'created_at'            => new DateTime,
                'updated_at'            => new DateTime
            ),
            array(
                'user_id'               => $user_id,
                'i18n_title'            => $i18n_title2,
                'i18n_url'              => $i18n_url2,
                'img'                   => '',
                'i18n_content'          => $i18n_content2,
                'i18n_meta_title'       => $i18n_meta_title2,
                'i18n_meta_description' => $i18n_meta_description2,
                'created_at'            => new DateTime,
                'updated_at'            => new DateTime
            ))
        );
    }

}
