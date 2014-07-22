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

        $t_fr = 'Exemple article 1';
        $t_en = 'Article exemple 1';

        //article1
        $title1 = new I18N;
        $title1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title1->save();
        $title1->translate('fr_FR',$t_fr);
        $title1->translate('en_EN',$t_en);
        
        $url1 = new I18N;
        $url1->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url1->save();
        $url1->translate('fr_FR',Str::slug($t_fr));
        $url1->translate('en_EN',Str::slug($t_en));

        $content1 = new I18N;
        $content1->i18n_type_id = I18nType::where('name','=','content')->first()->id;
        $content1->save();
        $content1->translate('fr_FR',$this->content);
        $content1->translate('en_EN',$this->content);

        $meta_title1 = new I18N;
        $meta_title1->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title1->save();
        $meta_title1->translate('fr_FR',$t_fr);
        $meta_title1->translate('en_EN',$t_en);

        $meta_description1 = new I18N;
        $meta_description1->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description1->save();
        $meta_description1->translate('fr_FR','Description '.$t_fr);
        $meta_description1->translate('en_EN',$t_en.' Description');

        $structure1 = Structure::create(array(
                'i18n_title'                => $title1->id,
                'i18n_url'                  => $url1->id,
                'i18n_meta_title'           => $meta_title1->id,
                'i18n_meta_description'     => $meta_description1->id
            ));

        $t_fr2 = 'Exemple article 2';
        $t_en2 = 'Article exemple 2';

        //article1
        $title2 = new I18N;
        $title2->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title2->save();
        $title2->translate('fr_FR',$t_fr2);
        $title2->translate('en_EN',$t_en2);
        
        $url2 = new I18N;
        $url2->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url2->save();
        $url2->translate('fr_FR',Str::slug($t_fr2));
        $url2->translate('en_EN',Str::slug($t_en2));

        $content2 = new I18N;
        $content2->i18n_type_id = I18nType::where('name','=','content')->first()->id;
        $content2->save();
        $content2->translate('fr_FR',$this->content);
        $content2->translate('en_EN',$this->content);

        $meta_title2 = new I18N;
        $meta_title2->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title2->save();
        $meta_title2->translate('fr_FR',$t_fr2);
        $meta_title2->translate('en_EN',$t_en2);

        $meta_description2 = new I18N;
        $meta_description2->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description2->save();
        $meta_description2->translate('fr_FR','Description '.$t_fr2);
        $meta_description2->translate('en_EN',$t_en2.' Description');

        $structure2 = Structure::create(array(
                'i18n_title'                => $title2->id,
                'i18n_url'                  => $url2->id,
                'i18n_meta_title'           => $meta_title2->id,
                'i18n_meta_description'     => $meta_description2->id
            ));

        

        DB::table('articles')->insert( array(
            array(
                'user_id'               => $user_id,
                'structure_id'             => $structure1->id,
                'img'                   => null,
                'i18n_content'          => $content1->id,
                'created_at'            => new DateTime,
                'updated_at'            => new DateTime
            ),
            array(
                'user_id'               => $user_id,
                'structure_id'             => $structure2->id,
                'img'                   => null,
                'i18n_content'          => $content2->id,
                'created_at'            => new DateTime,
                'updated_at'            => new DateTime
            ))
        );
    }

}
