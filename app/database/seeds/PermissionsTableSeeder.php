<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();

        $roles = array();
        $roles[0] = Role::where('name','=','admin')->first()->id;
        $roles[1] = Role::where('name','=','visitor')->first()->id;

        $resources = array();
        $resources[0] = Resource::where('name','=','blog')->first()->id;
        $resources[1] = Resource::where('name','=','article')->first()->id;
        $resources[2] = Resource::where('name','=','article_category')->first()->id;
        $resources[3] = Resource::where('name','=','tag')->first()->id;
        $resources[4] = Resource::where('name','=','mosaic')->first()->id;
        $resources[5] = Resource::where('name','=','gallery')->first()->id;
        $resources[6] = Resource::where('name','=','image')->first()->id;
        $resources[7] = Resource::where('name','=','page')->first()->id;
        $resources[8] = Resource::where('name','=','menu')->first()->id;
        $resources[9] = Resource::where('name','=','role')->first()->id;
        $resources[10] = Resource::where('name','=','user')->first()->id;

        $actions = array();
        $actions[0]  = Action::where('name','=','create')->first()->id;
        $actions[1]  = Action::where('name','=','read')->first()->id;
        $actions[2]  = Action::where('name','=','update')->first()->id;
        $actions[3]  = Action::where('name','=','delete')->first()->id;

        $data = array();

        foreach($roles as $role){            
            foreach($resources as $resource){
                foreach($actions as $action){
                    $data[] = array(
                        'role_id'       => $role,
                        'type'          => ( $role == $roles[0] ? 'allow' : 'deny'),
                        'action_id'     => $action,
                        'resource_id'   => $resource
                    );
                }
            }
        }

        DB::table('permissions')->insert( $data );
    }
}
