<?php

class ActionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('actions')->delete();

        DB::table('actions')->insert( array(
            //CRUD
            array(
                'name' => 'create'
            ),
            array(
                'name' => 'read'
            ),
            array(
                'name' => 'update'
            ),
            array(
                'name' => 'delete'
            ))
        );
    }

}
