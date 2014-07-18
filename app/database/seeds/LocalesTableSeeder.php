<?php

class LocalesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('locale')->delete();

        DB::table('locale')->insert( array(
            array(
                'id' 	=> 'fr',
                'name'	=> 'France'
            ),
            array(
                'id'    => 'en',
                'name'  => 'United Kingdom'
            ),
            array(
                'id' 	=> 'en_US',
                'name'	=> 'United States'
            ))
        );
    }

}
