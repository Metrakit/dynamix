<?php

class ResourcesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('resources')->delete();

        DB::table('resources')->insert( array(
            //Blog
            array(
                'name' => 'blog',
                'icon' => 'glyphicon glyphicon-book',
                'model' => 'Blog'
            ),
            array(
                'name' => 'article',
                'icon' => 'glyphicon glyphicon-book',
                'model' => 'Article'
            ),
            array(
                'name' => 'article_category',
                'icon' => 'glyphicon glyphicon-book',
                'model' => 'ArticleCategory'
            ),
            
            //Media
            array(
                'name' => 'media',
                'icon' => 'glyphicon glyphicon-picture',
                'model' => null
            ),
            /*array(
                'name' => 'image',
                'icon' => 'glyphicon glyphicon-picture',
                'model' => 'Image'
            ),
            array(
                'name' => 'video',
                'icon' => 'glyphicon glyphicon-film',
                'model' => 'Video'
            ),
            array(
                'name' => 'audio',
                'icon' => 'glyphicon glyphicon-music',
                'model' => 'Audio'
            ),*/

            //Gallery Image
            array(
                'name' => 'mosaic',
                'icon' => 'glyphicon glyphicon-picture',
                'model' => 'Mosaic'
            ),
            array(
                'name' => 'gallery',
                'icon' => 'glyphicon glyphicon-picture',
                'model' => 'Gallery'
            ),

            //Page
            array(
                'name' => 'page',
                'icon' => 'glyphicon glyphicon-book',
                'model' => 'Page'
            ),

            //Conector
            array(
                'name' => 'tag',
                'icon' => 'glyphicon glyphicon-tag',
                'model' => 'Tag'
            ),

            //Menu
            array(
                'name' => 'navigation',
                'icon' => 'glyphicon glyphicon-list',
                'model' => 'Nav'
            ),
            
            //User
            array(
                'name' => 'role',
                'icon' => 'glyphicon glyphicon-lock',
                'model' => 'Role'
            ),
            array(
                'name' => 'user',
                'icon' => 'glyphicon glyphicon-user',
                'model' => 'User'
            ),


            //System
            array(
                'name' => 'environment',
                'icon' => 'glyphicon glyphicon-list',
                'model' => null
            ),
            array(
                'name' => 'log',
                'icon' => 'glyphicon glyphicon-list',
                'model' => 'Track'
            ),
            array(
                'name' => 'setting',
                'icon' => 'glyphicon glyphicon-cog',
                'model' => 'Option'
            ))
        );
    }

}
