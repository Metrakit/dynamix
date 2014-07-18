<?php

class ViewsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('views')->delete();

        DB::table('views')->insert( array(
            array(
                'path'       => 'public.pages.content',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
