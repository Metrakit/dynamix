<?php

class RoleUserTableSeeder extends Seeder {


    public function run()
    {
        DB::table('role_user')->delete();

        $user_id1 = User::find(1)->id;
        $user_id2 = User::find(2)->id;
        $user_id3 = User::find(3)->id;
        $role_id1 = Role::where('name','=','admin')->first()->id;
        $role_id2 = Role::where('name','=','moderator')->first()->id;

        DB::table('role_user')->insert( array(
            array(
                'user_id'    => $user_id1,
                'role_id'    => $role_id1
            ),
            array(
                'user_id'    => $user_id2,
                'role_id'    => $role_id1
            ),
            array(
                'user_id'    => $user_id3,
                'role_id'    => $role_id2
            ))
        );
    }

}
