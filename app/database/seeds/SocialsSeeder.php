<?php

class SocialsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('socials')->delete();

        DB::table('socials')->insert( array(
            array(
                'name'  => 'facebook'
            ),
            array(
                'name'  => 'twitter'
            )
        ));
    }

}
