<?php

class OnePagesTableSeeder extends Seeder {

    public function run()
    {
        //Background_types
        DB::table('background_types')->delete();
        DB::table('background_types')->insert( array(
            array(
                'name'       => 'image'
            ),
            array(
                'name'       => 'video'
            )
        ));    

        //Background_positions
        DB::table('background_positions')->delete();
        DB::table('background_positions')->insert( array(
            array(
                'name'       => 'relative'
            ),
            array(
                'name'       => 'fixed'
            )
        ));    


        //Backgrounds
        DB::table('backgrounds')->delete();
        DB::table('backgrounds')->insert( array(
            array(
                'url'                       => 'uploads/pictures/album cute kitten/cute-kitten-2.jpg',
                'background_type_id'        => 1,
                'background_position_id'    => 1
            ),
            array(
                'url'                       => 'uploads/medias/vjing.mp4',
                'background_type_id'        => 2,
                'background_position_id'    => 1
            )
        ));    

    }

}