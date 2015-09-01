<?php

use Illuminate\Database\Seeder;

use Dynamix\Models\Viewr;

class ViewsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('views')->delete();

        /*DB::table('views')->insert( array(
            array(
                'path'       => 'public.pages.content',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ))
        );*/

        $view['radio'] = Viewr::create(array(
            'name'              => 'radio',
            'path'              => 'public.form.input.radio',
        ));

        $view['textarea'] = Viewr::create(array(
            'name'              => 'textarea',
            'path'              => 'public.form.input.textarea',
        ));

        $view['text'] = Viewr::create(array(
            'name'              => 'text',
            'path'              => 'public.form.input.text',
        ));

        $view['password'] = Viewr::create(array(
            'name'              => 'password',
            'path'              => 'public.form.input.password',
        ));

        $view['hidden'] = Viewr::create(array(
            'name'              => 'hidden',
            'path'              => 'public.form.input.hidden',
        ));        

        $view['checkbox'] = Viewr::create(array(
            'name'              => 'checkbox',
            'path'              => 'public.form.input.checkbox',
        ));     

        $view['submit'] = Viewr::create(array(
            'name'              => 'submit',
            'path'              => 'public.form.input.submit',
        ));  

        $view['select'] = Viewr::create(array(
            'name'              => 'select',
            'path'              => 'public.form.input.select',
        )); 

        $view['multiselect'] = Viewr::create(array(
            'name'              => 'multiselect',
            'path'              => 'public.form.input.multiselect',
        )); 
        
        $view['filemanager'] = Viewr::create(array(
            'name'              => 'filemanager',
            'path'              => 'public.form.input.filemanager',
        )); 

    }

}
