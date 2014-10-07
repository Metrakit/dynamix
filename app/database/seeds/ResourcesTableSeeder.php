<?php

class ResourcesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('resources')->delete();

        DB::table('resources')->insert( array(
            //Blog
            /*array(
                'name' => 'blog',
                'icon' => 'glyphicon glyphicon-book',
                'model' => 'Blog',
                'in_admin_ui'   => true,
                'navigable'     => true
            ),
            array(
                'name' => 'article',
                'icon' => 'glyphicon glyphicon-book',
                'model' => 'Article',
                'in_admin_ui'   => true,
                'navigable'     => true
            ),
            array(
                'name' => 'article_category',
                'icon' => 'glyphicon glyphicon-book',
                'model' => 'ArticleCategory',
                'in_admin_ui'   => true,
                'navigable'     => true
            ),
            */
            //Media
            array(
                'name' => 'media',
                'icon' => 'glyphicon glyphicon-picture',
                'model' => null,
                'in_admin_ui'   => true,
                'navigable'     => false
            ),
            /*array(
                'name' => 'image',
                'icon' => 'glyphicon glyphicon-picture',
                'model' => 'Image',
                'in_admin_ui'   => true,
                'navigable'     => true
            ),
            array(
                'name' => 'video',
                'icon' => 'glyphicon glyphicon-film',
                'model' => 'Video',
                'in_admin_ui'   => true,
                'navigable'     => true
            ),
            array(
                'name' => 'audio',
                'icon' => 'glyphicon glyphicon-music',
                'model' => 'Audio',
                'in_admin_ui'   => true,
                'navigable'     => true
            ),*/

            //Gallery Image
            /*array(
                'name' => 'mosaic',
                'icon' => 'glyphicon glyphicon-picture',
                'model' => 'Mosaic',
                'in_admin_ui'   => true,
                'navigable'     => true
            ),
            array(
                'name' => 'gallery',
                'icon' => 'glyphicon glyphicon-picture',
                'model' => 'Gallery',
                'in_admin_ui'   => true,
                'navigable'     => true
            ),*/

            //Page
            array(
                'name' => 'page',
                'icon' => 'glyphicon glyphicon-book',
                'model' => 'Page',
                'in_admin_ui'   => true,
                'navigable'     => true
            ),
            array(
                'name' => 'block',
                'icon' => 'glyphicon glyphicon-book',
                'model' => 'Block',
                'in_admin_ui'   => false,
                'navigable'     => false
            ),
            array(
                'name' => 'block_content',
                'icon' => 'glyphicon glyphicon-book',
                'model' => 'BlockContent',
                'in_admin_ui'   => false,
                'navigable'     => false
            ),

            //Conector
            array(
                'name' => 'tag',
                'icon' => 'glyphicon glyphicon-tag',
                'model' => 'Tag',
                'in_admin_ui'   => true,
                'navigable'     => false
            ),

            //Menu
            array(
                'name' => 'navigation',
                'icon' => 'glyphicon glyphicon-list',
                'model' => 'Nav',
                'in_admin_ui'   => true,
                'navigable'     => false
            ),
            
            //User
            array(
                'name' => 'role_permission',
                'icon' => 'glyphicon glyphicon-lock',
                'model' => null,
                'in_admin_ui'   => true,
                'navigable'     => false
            ),
            array(
                'name' => 'role',
                'icon' => 'glyphicon glyphicon-lock',
                'model' => 'Role',
                'in_admin_ui'   => false,
                'navigable'     => false
            ),
            array(
                'name' => 'permission',
                'icon' => 'glyphicon glyphicon-lock',
                'model' => 'Permission',
                'in_admin_ui'   => false,
                'navigable'     => false
            ),
            array(
                'name' => 'user',
                'icon' => 'glyphicon glyphicon-user',
                'model' => 'User',
                'in_admin_ui'   => true,
                'navigable'     => false
            ),


            //System
            array(
                'name' => 'environment',
                'icon' => 'glyphicon glyphicon-globe',
                'model' => null,
                'in_admin_ui'   => true,
                'navigable'     => false
            ),
            array(
                'name' => 'log',
                'icon' => 'glyphicon glyphicon-list',
                'model' => 'Track',
                'in_admin_ui'   => true,
                'navigable'     => false
            ),
            array(
                'name' => 'option',
                'icon' => 'glyphicon glyphicon-cog',
                'model' => 'Option',
                'in_admin_ui'   => true,
                'navigable'     => false
            ))
        );
    }

}
