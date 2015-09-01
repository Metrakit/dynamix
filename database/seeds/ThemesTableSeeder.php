<?php

use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder {


    public function run()
    {
        DB::table('themes')->delete();

        DB::table('themes')->insert( array(
            array(
                'name'    	=> 'default',
                'type'    	=> 'public',
                'active'    	=> true
            ),
            array(
                'name'    	=> 'default',
                'type'    	=> 'admin',
                'active'    	=> true
            ))
        );
    }

}
