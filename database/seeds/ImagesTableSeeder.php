<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('images')->delete();

        DB::table('images')->insert( array(
            array(
                'file_name'  => 'pictures/album cute kitten/cute-kitten-1',
                'file_ext'   => 'jpg',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime
            ),
            array(
                'file_name'  => 'pictures/album cute kitten/cute-kitten-2',
                'file_ext'   => 'jpg',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime
            ))
        );
    }

}
