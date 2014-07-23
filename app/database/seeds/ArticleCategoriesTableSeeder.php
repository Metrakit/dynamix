<?php

class ArticleCategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('article_categories')->delete();

        $article_category = new ArticleCategory;
        $article_category->save();        

        $t_fr = 'Développement Web';
        $t_en = 'Web development';

        $title = new I18N;
        $title->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title->save();
        $title->translate('fr_FR',$t_fr);
        $title->translate('en_EN',$t_en);

        $url = new I18N;
        $url->i18n_type_id = I18nType::where('name','=','url')->first()->id;
        $url->save();
        $url->translate('fr_FR','/'.Str::slug($t_fr));
        $url->translate('en_EN','/'.Str::slug($t_en));

        $meta_title = new I18N;
        $meta_title->i18n_type_id = I18nType::where('name','=','meta_title')->first()->id;
        $meta_title->save();
        $meta_title->translate('fr_FR',$t_fr);
        $meta_title->translate('en_EN',$t_en);

        $meta_description = new I18N;
        $meta_description->i18n_type_id = I18nType::where('name','=','meta_description')->first()->id;
        $meta_description->save();
        $meta_description->translate('fr_FR','Description '.$t_fr);
        $meta_description->translate('en_EN',$t_en.' Description');

        $structure = Structure::create(array(
                'i18n_title'                => $title->id,
                'i18n_url'                  => $url->id,
                'i18n_meta_title'           => $meta_title->id,
                'i18n_meta_description'     => $meta_description->id,
                'structurable_id'           => $article_category->id,
                'structurable_type'         => 'article_categories'
            ));
    }

}
