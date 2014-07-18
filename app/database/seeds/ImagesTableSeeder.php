<?php

class ImagesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('images')->delete();

        $slider = Slider::find(1);

        DB::table('images')->insert( array(
            array(
                'file_name'  => 'cute-kitten-1',
                'file_ext'   => 'jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'file_name'  => 'cute-kitten-2',
                'file_ext'   => 'jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
