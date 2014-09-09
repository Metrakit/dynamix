<?php

class ResourcesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('resources')->delete();

        DB::table('resources')->insert( array(
            //Blog
            array(
                'name' => 'blog',
                'icon' => 'glyphicon glyphicon-book'
            ),
            array(
                'name' => 'article',
                'icon' => 'glyphicon glyphicon-book'
            ),
            array(
                'name' => 'article_category',
                'icon' => 'glyphicon glyphicon-book'
            ),
            
            //Media
            array(
                'name' => 'media',
                'icon' => 'glyphicon glyphicon-picture'
            ),
            /*array(
                'name' => 'image',
                'icon' => 'glyphicon glyphicon-picture'
            ),
            array(
                'name' => 'video',
                'icon' => 'glyphicon glyphicon-film'
            ),
            array(
                'name' => 'audio',
                'icon' => 'glyphicon glyphicon-music'
            ),*/

            //Gallery Image
            array(
                'name' => 'mosaic',
                'icon' => 'glyphicon glyphicon-picture'
            ),
            array(
                'name' => 'gallery',
                'icon' => 'glyphicon glyphicon-picture'
            ),

            //Page
            array(
                'name' => 'page',
                'icon' => 'glyphicon glyphicon-book'
            ),

            //Conector
            array(
                'name' => 'tag',
                'icon' => 'glyphicon glyphicon-tag'
            ),

            //Menu
            array(
                'name' => 'navigation',
                'icon' => 'glyphicon glyphicon-list'
            ),
            
            //User
            array(
                'name' => 'role',
                'icon' => 'glyphicon glyphicon-lock'
            ),
            array(
                'name' => 'user',
                'icon' => 'glyphicon glyphicon-user'
            ),


            //System
            array(
                'name' => 'log',
                'icon' => 'glyphicon glyphicon-list'
            ),
            array(
                'name' => 'setting',
                'icon' => 'glyphicon glyphicon-cog'
            ))
        );
    }

}
