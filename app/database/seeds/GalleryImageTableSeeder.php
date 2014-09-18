<?php

class GalleryImageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('gallery_image')->delete();

        $gallery1 = Gallery::find(1)->id;

        $file1 = Files::find(1)->id;
        $file2 = Files::find(2)->id;

        DB::table('gallery_image')->insert( array(
            array(
                'gallery_id'        => $gallery1,
                'image_id'            => $file1
            ),
            array(
                'gallery_id'        => $gallery1,
                'image_id'            => $file2
            ))
        );
    }

}
