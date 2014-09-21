<?php

class FileTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('file_types')->delete();

        DB::table('file_types')->insert( array(
            array(
                'name'       => 'image'
            ),
            array(
                'name'       => 'video'
            ),
            array(
                'name'       => 'audio'
            ),
            array(
                'name'       => 'archive'
            ))
        );
    }

}
