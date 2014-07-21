<?php

class SlidersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('sliders')->delete();

        $title = new I18N;
        $title->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title->save();
        $title->translate('fr_FR','Slider Démo');
        $title->translate('en_EN','Demo Slider');

        DB::table('sliders')->insert( array(
            array(
                'i18n_title' => $title->id,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
