<?php

use Illuminate\Database\Seeder;

use Dynamix\Models\Role;
use Dynamix\Models\Action;
use Dynamix\Models\Resource;

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();

        $roles = array();
        $roles[0] = Role::where('name','=','admin')->first()->id;
        $roles[1] = Role::where('name','=','moderator')->first()->id;

        $resources = Resource::all();

        $actions = array();
        $actions[0]  = Action::where('name','=','manage')->first()->id;
        /*
        $actions[0]  = Action::where('name','=','create')->first()->id;
        $actions[1]  = Action::where('name','=','read')->first()->id;
        $actions[2]  = Action::where('name','=','update')->first()->id;
        $actions[3]  = Action::where('name','=','delete')->first()->id
        */

        $data = array();

        foreach($roles as $role){            
            foreach($resources as $resource){
                foreach($actions as $action){
                    $data[] = array(
                        'role_id'       => $role,
                        'type'          => ( $role == $roles[0] || ( $resource->name != 'role' && $resource->name != 'auth' ) ? 'allow' : 'deny'),
                        'action_id'     => $action,
                        'resource_id'   => $resource->id
                        );
                }
            }
        }

        DB::table('permissions')->insert( $data );
    }
}
