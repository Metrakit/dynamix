<?php

class BlocksTableSeeder extends Seeder {

    public function run()
    {
        DB::table('blocks')->delete();

        DB::table('blocks')->insert( array(
            array(
                'blockable_id'  => 1,
                'blockable_type'=> 'BlockContent',
                'page_id'       => 1,
                'order'         => 0
            ),array(
                'blockable_id'  => 2,
                'blockable_type'=> 'BlockContent',
                'page_id'       => 1,
                'order'         => 1
            ),array(
                'blockable_id'  => 3,
                'blockable_type'=> 'BlockContent',
                'page_id'       => 1,
                'order'         => 2
            ),array(
                'blockable_id'  => 4,
                'blockable_type'=> 'BlockContent',
                'page_id'       => 1,
                'order'         => 3
            ),
            array(
                'blockable_id'  => 5,
                'blockable_type'=> 'BlockContent',
                'page_id'       => 2,
                'order'         => 0
            ),
            array(
                'blockable_id'  => 1,
                'blockable_type'=> 'Formr',
                'page_id'       => 2,
                'order'         => 1
            ))
        );
    }

}
