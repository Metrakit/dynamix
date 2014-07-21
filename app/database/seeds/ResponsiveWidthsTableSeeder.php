<?php

class ResponsiveWidthsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('responsive_widths')->delete();

        DB::table('responsive_widths')->insert( array(
            array(
                'name'      => '1/12',
                'value'     => '1'
            ),
            array(
                'name'      => '2/12',
                'value'     => '2'
            ),
            array(
                'name'      => '3/12',
                'value'     => '3'
            ),
            array(
                'name'      => '4/12',
                'value'     => '4'
            ),
            array(
                'name'      => '5/12',
                'value'     => '5'
            ),
            array(
                'name'      => '6/12',
                'value'     => '6'
            ),
            array(
                'name'      => '7/12',
                'value'     => '7'
            ),
            array(
                'name'      => '8/12',
                'value'     => '8'
            ),
            array(
                'name'      => '9/12',
                'value'     => '9'
            ),
            array(
                'name'      => '10/12',
                'value'     => '10'
            ),
            array(
                'name'      => '11/12',
                'value'     => '11'
            ),
            array(
                'name'      => '12/12',
                'value'     => '12'
            ))
        );
    }

}
