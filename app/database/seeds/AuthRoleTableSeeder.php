<?php

class AuthRoleTableSeeder extends Seeder {


    public function run()
    {
        DB::table('auth_role')->delete();

        $auth_id1 = AuthUser::find(1)->id;
        $auth_id2 = AuthUser::find(2)->id;
        $auth_id3 = AuthUser::find(3)->id;
        $auth_id4 = AuthUser::find(4)->id;
        $auth_id5 = AuthUser::find(5)->id;
        $auth_id6 = AuthUser::find(6)->id;
        $role_id1 = Role::where('name','=','admin')->first()->id;
        $role_id2 = Role::where('name','=','moderator')->first()->id;

        DB::table('auth_role')->insert( array(
            array(
                'auth_id'    => $auth_id1,
                'role_id'    => $role_id1
                ),
            array(
                'auth_id'    => $auth_id2,
                'role_id'    => $role_id1
                ),
            array(
                'auth_id'    => $auth_id3,
                'role_id'    => $role_id2
                ),
            array(
                'auth_id'    => $auth_id4,
                'role_id'    => $role_id1
                ),
            array(
                'auth_id'    => $auth_id5,
                'role_id'    => $role_id1
                ),
            array(
                'auth_id'    => $auth_id6,
                'role_id'    => $role_id1
                ),
            )
        );
    }

}
