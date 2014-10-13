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
                'favourite_lang'=> 'fr',
                'last_visit_at' => new DateTime,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'firstname' => 'jordane',
                'lastname'  => 'jouffroy',
                'pseudo'    => 'jjouffroy',
                'email'     => 'j.jouffroy@outlouk.com',
                'password'  => Hash::make('admin'),
                'favourite_lang'=> 'fr',
                'last_visit_at' => new DateTime,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'firstname' => 'moder',
                'lastname'  => 'ator',
                'pseudo'    => 'mator',
                'email'     => 'm.ator@gmail.com',
                'password'  => Hash::make('moderator'),
                'favourite_lang'=> 'fr',
                'last_visit_at' => new DateTime,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
