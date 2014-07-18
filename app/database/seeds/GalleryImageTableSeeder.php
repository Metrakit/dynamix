<?php

class GalleryImageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('gallery_image')->delete();

        $gallery1 = Gallery::find(1)->id;

        $image1 = Image::find(1)->id;
        $image2 = Image::find(2)->id;

        DB::table('gallery_image')->insert( array(
            array(
                'gallery_id'        => $gallery1,
                'image_id'            => $image1
            ),
            array(
                'gallery_id'        => $gallery1,
                'image_id'            => $image2
            ))
        );
    }

}
