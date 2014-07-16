<?php

class RoleUserTableSeeder extends Seeder {


    public function run()
    {
        DB::table('role_user')->delete();

        $user_id = User::find(1)->id;
        $role_id = Role::where('name','=','admin')->first()->id;

        DB::table('role_user')->insert( array(
            array(
                'user_id'    => $user_id,
                'role_id'    => $role_id
            ))
        );
    }

}
