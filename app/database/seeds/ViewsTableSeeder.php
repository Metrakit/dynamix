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

        $view['radio'] = Viewr::create(array(
            'path'              => 'public.form.input.radio',
        ));

        $view['textarea'] = Viewr::create(array(
            'path'              => 'public.form.input.textarea',
        ));

        $view['text'] = Viewr::create(array(
            'path'              => 'public.form.input.text',
        ));

        $view['password'] = Viewr::create(array(
            'path'              => 'public.form.input.password',
        ));

        $view['hidden'] = Viewr::create(array(
            'path'              => 'public.form.input.hidden',
        ));        

        $view['checkbox'] = Viewr::create(array(
            'path'              => 'public.form.input.checkbox',
        ));     

        $view['submit'] = Viewr::create(array(
            'path'              => 'public.form.input.submit',
        ));  

        $view['select'] = Viewr::create(array(
            'path'              => 'public.form.input.select',
        )); 

        
    }

}
