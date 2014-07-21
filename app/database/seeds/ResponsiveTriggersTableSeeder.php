<?php

class ResponsiveTriggersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('responsive_triggers')->delete();

        DB::table('responsive_triggers')->insert( array(
            array(
                'name'      => 'extra-small',
                'value'     => 'xs',
                'priority'  => 10
            ),
            array(
                'name'      => 'small',
                'value'     => 'sm',
                'priority'  => 20
            ),
            array(
                'name'      => 'medium',
                'value'     => 'md',
                'priority'  => 30
            ),
            array(
                'name'      => 'large',
                'value'     => 'lg',
                'priority'  => 40
            ))
        );
    }

}
