<?php

class BlockResponsiveTableSeeder extends Seeder {

    public function run()
    {
        DB::table('block_responsive')->delete();

        DB::table('block_responsive')->insert( array(
            array(
                'block_id'      => 1,
                'responsive_width_id'       => 12,
                'responsive_trigger_id'       => 3
            ),
            array(
                'block_id'      => 2,
                'responsive_width_id'       => 12,
                'responsive_trigger_id'       => 3
            ))
        );
    }

}
