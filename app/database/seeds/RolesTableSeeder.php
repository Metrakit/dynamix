<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert( array(
            array(
                'name'              => 'visitor',
                'inherited_role_id' => null,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime
            ),
            array(
                'name'              => 'admin',
                'inherited_role_id' => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime
            ))
        );
    }

}
