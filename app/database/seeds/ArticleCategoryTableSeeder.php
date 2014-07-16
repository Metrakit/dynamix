<?php

class ArticleCategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('article_category')->delete();

        $article1 = Article::find(1)->id;
        $article2 = Article::find(2)->id;

        $category = ArticleCategory::find(1)->id;

        DB::table('article_category')->insert( array(
            array(
                'article_id' => $article1,
                'category_id' => $category
            ),
            array(
                'article_id' => $article2,
                'category_id' => $category
            ))
        );
    }

}
