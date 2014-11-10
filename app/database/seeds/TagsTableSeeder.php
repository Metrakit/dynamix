<?php

class TagsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tags')->delete();

        $t_fr1 = 'JavaScript';
        $t_en1 = 'JavaScript';

        $name1 = new I18N;
        $name1->i18n_type_id = I18nType::where('name','=','tag')->first()->id;
        $name1->save();
        $name1->translate('fr',$t_fr1);
        $name1->translate('en',$t_en1);


        $t_fr2 = 'PHP';
        $t_en2 = 'PHP';

        $name2 = new I18N;
        $name2->i18n_type_id = I18nType::where('name','=','tag')->first()->id;
        $name2->save();
        $name2->translate('fr',$t_fr2);
        $name2->translate('en',$t_en2);


        $t_fr3 = 'Laravel';
        $t_en3 = 'Laravel';

        $name3 = new I18N;
        $name3->i18n_type_id = I18nType::where('name','=','tag')->first()->id;
        $name3->save();
        $name3->translate('fr',$t_fr3);
        $name3->translate('en',$t_en3);

        DB::table('tags')->insert( array(
            array(
                'i18n_name'       =>  $name1->id,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'i18n_name'       =>  $name2->id,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'i18n_name'       =>  $name3->id,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );
    }

}
