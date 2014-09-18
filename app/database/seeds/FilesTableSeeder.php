<?php

class FilesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('files')->delete();

        DB::table('files')->insert( array(
            array(
                'path'       => '../uploads/pictures/album cute kitten/cute-kitten-1.jpg',
                'type_id'       => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'path'       => '../uploads/pictures/album cute kitten/cute-kitten-2.jpg',
                'type_id'       => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
