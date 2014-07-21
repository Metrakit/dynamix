<?php

class LocalesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('locales')->delete();

        DB::table('locales')->insert( array(
            array(
                'id' 	=> 'fr_FR',
                'name'	=> 'France',
                'enable'=> 1
            ),
            array(
                'id'    => 'en_EN',
                'name'  => 'United Kingdom',
                'enable'=> 1
            ),
            array(
                'id' 	=> 'en_US',
                'name'	=> 'United States',
                'enable'=> 0
            ))
        );
    }
}
