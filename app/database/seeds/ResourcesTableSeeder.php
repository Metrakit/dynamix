<?php

class ResourcesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('resources')->delete();

        DB::table('resources')->insert( array(

            //Media
            array(
                'name' => 'media',
                'icon' => 'glyphicon glyphicon-picture',
                'model' => null,
                'in_admin_ui'   => true,
                'navigable'     => false,
                'admin_navigation_group_id' => 1
            ),


            //Conector
            /*array(
                'name' => 'tag',
                'icon' => 'glyphicon glyphicon-tag',
                'model' => 'Tag',
                'in_admin_ui'   => false,
                'navigable'     => false,
                'admin_navigation_group_id'     => 2
            ),*/

            //Menu
            array(
                'name' => 'navigation',
                'icon' => 'glyphicon glyphicon-list',
                'model' => 'Nav',
                'in_admin_ui'   => true,
                'navigable'     => false,
                'admin_navigation_group_id'     => 2
            ),
            array(
                'name' => 'navigation_link',
                'icon' => 'glyphicon glyphicon-list',
                'model' => 'NavLink',
                'in_admin_ui'   => false,
                'navigable'     => true,
                'admin_navigation_group_id' => null
            ),

                        //User
            array(
                'name' => 'role_permission',
                'icon' => 'glyphicon glyphicon-lock',
                'model' => null,
                'in_admin_ui'   => true,
                'navigable'     => false,
                'admin_navigation_group_id'     => 3
            ),
            array(
                'name' => 'role',
                'icon' => 'glyphicon glyphicon-lock',
                'model' => 'Role',
                'in_admin_ui'   => false,
                'navigable'     => false,
                'admin_navigation_group_id' => null
            ),
            array(
                'name' => 'permission',
                'icon' => 'glyphicon glyphicon-lock',
                'model' => 'Permission',
                'in_admin_ui'   => false,
                'navigable'     => false,
                'admin_navigation_group_id' => null
            ),
            array(
                'name' => 'auth',
                'icon' => 'glyphicon glyphicon-user',
                'model' => 'AuthUser',
                'in_admin_ui'   => true,
                'navigable'     => false,
                'admin_navigation_group_id'     => 3
            ),


                        //System
            array(
                'name' => 'environment',
                'icon' => 'glyphicon glyphicon-globe',
                'model' => null,
                'in_admin_ui'   => true,
                'navigable'     => false,
                'admin_navigation_group_id'     => 4
            ),
            array(
                'name' => 'log',
                'icon' => 'glyphicon glyphicon-list',
                'model' => 'Track',
                'in_admin_ui'   => true,
                'navigable'     => false,
                'admin_navigation_group_id'     => 3
            ),
            array(
                'name' => 'option',
                'icon' => 'glyphicon glyphicon-cog',
                'model' => 'Option',
                'in_admin_ui'   => true,
                'navigable'     => false,
                'admin_navigation_group_id'     => 5
            ),
            array(
                'name' => 'i18n-constant',
                'icon' => 'glyphicon glyphicon-globe',
                'model' => null,
                'in_admin_ui'   => true,
                'navigable'     => false,
                'admin_navigation_group_id'     => 4
            ),
            array(
                'name' => 'form',
                'icon' => 'glyphicon glyphicon-tasks',
                'model' => 'Formr',
                'in_admin_ui'   => true,
                'navigable'     => false,
                'admin_navigation_group_id'     => 2
            )


));
}

}
