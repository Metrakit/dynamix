<?php

class AuthsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('auths')->delete();

        DB::table('auths')->insert( array(
            array(
                'email'     => 'd.lepaux@gmail.com',
                'password'  => Hash::make('admin'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            array(
                'email'     => 'contact@jordane.net',
                'password'  => Hash::make('admin'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            array(
                'email'     => 'm.ator@gmail.com',
                'password'  => Hash::make('moderator'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            array(
                'email'     => 'choisy.tommy@gmail.com',
                'password'  => Hash::make('admin'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            )
        );
    }

}
