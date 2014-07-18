<?php

class ArticleTagTableSeeder extends Seeder {

    public function run()
    {
        DB::table('article_tag')->delete();

        $tag1 = Tag::find(1)->id;
        $tag2 = Tag::find(2)->id;

        $article1 = Article::find(1)->id;
        $article2 = Article::find(2)->id;

        DB::table('article_tag')->insert( array(
            array(
                'article_id'        => $article1,
                'tag_id'            => $tag1
            ),
            array(
                'article_id'        => $article2,
                'tag_id'            => $tag2
            ))
        );
    }

}
