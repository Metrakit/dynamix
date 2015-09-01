<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert( array(
            array(
                'name'              => 'moderator',
                'inherited_role_id' => null,
                'deletable'         => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime
            ),
            array(
                'name'              => 'admin',
                'inherited_role_id' => 1,
                'deletable'         => 0,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime
            ))
        );
    }

}
