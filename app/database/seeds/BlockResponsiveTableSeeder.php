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
                'block_id'      => 1,
                'responsive_width_id'       => 3,
                'responsive_trigger_id'       => 1
            ),

            array(
                'block_id'      => 2,
                'responsive_width_id'       => 4,
                'responsive_trigger_id'       => 3
            ),
            
            array(
                'block_id'      => 3,
                'responsive_width_id'       => 4,
                'responsive_trigger_id'       => 3
            ),
            
            array(
                'block_id'      => 4,
                'responsive_width_id'       => 4,
                'responsive_trigger_id'       => 3
            ),

            array(
                'block_id'      => 5,
                'responsive_width_id'       => 12,
                'responsive_trigger_id'       => 3
            )/*, Former

            array(
                'block_id'      => 6,
                'responsive_width_id'       => 12,
                'responsive_trigger_id'       => 3
            )*/)
        );
    }

}
