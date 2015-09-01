<?php

use Illuminate\Database\Seeder;

class TaggablesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('taggables')->delete();
/*
        $tag1 = Tag::find(1)->id;
        $tag2 = Tag::find(2)->id;

        $article1 = Article::find(1)->id;
        $article2 = Article::find(2)->id;

        DB::table('taggables')->insert( array(
            array(
                'tag_id'            => $tag1,
                'taggable_id'       => $article1,
                'taggable_type'     => 'articles'
            ),
            array(
                'tag_id'            => $tag2,
                'taggable_id'       => $article2,
                'taggable_type'     => 'articles'
            ))
        );*/
    }

}
