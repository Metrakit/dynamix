<?php

class ArticleBlogTableSeeder extends Seeder {

    public function run()
    {
        DB::table('article_blog')->delete();

        $article1 = Article::find(1)->id;
        $article2 = Article::find(2)->id;

        $blog = Blog::find(1)->id;

        DB::table('article_blog')->insert( array(
            array(
                'article_id' => $article1,
                'blog_id' => $blog
            ),
            array(
                'article_id' => $article2,
                'blog_id' => $blog
            ))
        );
    }

}
