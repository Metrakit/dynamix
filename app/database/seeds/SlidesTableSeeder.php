<?php

class SlidesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('slides')->delete();

        $slider = Slider::find(1);

        $title1 = new I18N;
        $title1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title1->save();
        $title1->translate('fr_FR','Chatton mignon 1');
        $title1->translate('en_EN','Cute cat 1');

        $description1 = new I18N;
        $description1->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $description1->save();
        $description1->translate('fr_FR','Un petit chatton tout mignon');
        $description1->translate('en_EN','A very cutest kitten');


        $title2 = new I18N;
        $title2->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $title2->save();
        $title2->translate('fr_FR','Chatton mignon 2');
        $title2->translate('en_EN','Cute cat 2');

        $description2 = new I18N;
        $description2->i18n_type_id = I18nType::where('name','=','title')->first()->id;
        $description2->save();
        $description2->translate('fr_FR','Un petit chatton tout mignon');
        $description2->translate('en_EN','A very cutest kitten');




        DB::table('slides')->insert( array(
            array(
                'i18n_title'        => $title1->id,
                'i18n_description'  => $description1->id,
                'slider_id'         => $slider->id,
                'image_id'          => Image::find(1)->id,
                'background_color'  => null,
                'order'             => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'i18n_title'        => $title2->id,
                'i18n_description'  => $description2->id,
                'slider_id'         => $slider->id,
                'image_id'          => Image::find(2)->id,
                'background_color'  => null,
                'order'             => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
