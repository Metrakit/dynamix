<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert( array(
            array(
                'firstname' => 'david',
                'lastname'  => 'lepaux',
                'pseudo'    => 'dlepaux',
                'email'     => 'd.lepaux@gmail.com',
                'password'  => Hash::make('admin'),
                'last_visit_at' => new DateTime,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
