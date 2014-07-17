<?php

class I18nTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('i18n_types')->delete();

        DB::table('i18n_types')->insert( array(
            array(
                'name' => 'url'
            ),
            array(
                'name' => 'title'
            ),
            array(
                'name' => 'meta_title'
            ),
            array(
                'name' => 'description'
            ),
            array(
                'name' => 'meta_description'
            ),
            array(
                'name' => 'name'
            ),
            array(
                'name' => 'placeholder'
            ),
            array(
                'name' => 'helper'
            ))
        );
    }

}
