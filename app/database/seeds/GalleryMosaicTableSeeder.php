<?php

class GalleryMosaicTableSeeder extends Seeder {

    public function run()
    {
        DB::table('gallery_mosaic')->delete();

        $gallery1 = Gallery::find(1)->id;

        $mosaic1 = Mosaic::find(1)->id;

        DB::table('gallery_mosaic')->insert( array(
            array(
                'gallery_id'        => $gallery1,
                'mosaic_id'         => $mosaic1
            ))
        );
    }

}
