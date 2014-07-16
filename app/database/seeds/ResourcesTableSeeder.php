<?php

class ResourcesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('resources')->delete();

        DB::table('resources')->insert( array(
            //Blog system
            array(
                'name' => 'blog'
            ),
            array(
                'name' => 'article'
            ),
            array(
                'name' => 'article_category'
            ),
            array(
                'name' => 'tag'
            ),

            //Gallery Image
            array(
                'name' => 'mosaic'
            ),
            array(
                'name' => 'gallery'
            ),
            array(
                'name' => 'image'
            ),

            //Page
            array(
                'name' => 'page'
            ),

            //Menu
            array(
                'name' => 'menu'
            ),
            
            //User
            array(
                'name' => 'role'
            ),
            array(
                'name' => 'user'
            ))
        );
    }

}
