<?php

class ThemesTableSeeder extends Seeder {


    public function run()
    {
        DB::table('themes')->delete();

        $name = new I18N;
        $name->i18n_type_id = I18nType::where('name','=','name')->first()->id;
        $name->save();

        $name->translate('fr','Défaut');
        $name->translate('en','Default');

        DB::table('themes')->insert( array(
            array(
                'i18n_name'    	=> $name->id,
                'path'    		=> 'default',
                'active'    	=> true
            ))
        );
    }

}
