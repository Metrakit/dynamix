<?php

class BlogsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('blogs')->delete();

        $t_fr = 'Blog de David';
        $t_en = 'David\'s Blog';

        $title = new I18N;
        $title->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title->save();
        $title->translate('fr',$t_fr);
        $title->translate('en',$t_en);

        $url = new I18N;
        $url->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url->save();
        $url->translate('fr','/'.Str::slug($t_fr));
        $url->translate('en','/'.Str::slug($t_en));

        $meta_title = new I18N;
        $meta_title->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title->save();
        $meta_title->translate('fr',$t_fr);
        $meta_title->translate('en',$t_en);

        $meta_description = new I18N;
        $meta_description->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description->save();
        $meta_description->translate('fr','Description du blog');
        $meta_description->translate('en','Blog description');

        $structure = Structure::create(array(
                'i18n_title'                => $title->id,
                'i18n_url'                  => $url->id,
                'i18n_meta_title'           => $meta_title->id,
                'i18n_meta_description'     => $meta_description->id,
                'structurable_id'           => 1,
                'structurable_type'         => 'Blog'
            ));
            

        DB::table('blogs')->insert( array(
            array(
                'created_at'                => new DateTime,
                'updated_at'                => new DateTime
            ))
        );
    }

}
