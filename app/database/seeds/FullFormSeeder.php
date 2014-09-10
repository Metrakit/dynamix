<?php

class FullFormSeeder extends Seeder {


    public function run()
    {
        // Create a View (radio)
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

        $this->command->info('View created => next step');


        // Input types
        $InputType['radio'] = InputType::create(array(
            'name'              => 'radio',
        ));

        $InputType['textarea'] = InputType::create(array(
            'name'              => 'textarea',
        ));

        $InputType['text'] = InputType::create(array(
            'name'              => 'text',
        ));     

        $InputType['password'] = InputType::create(array(
            'name'              => 'password',
        ));  

        $InputType['hidden'] = InputType::create(array(
            'name'              => 'hidden',
        ));  

        $InputType['checkbox'] = InputType::create(array(
            'name'              => 'checkbox',
        ));  

         $InputType['submit'] = InputType::create(array(
            'name'              => 'submit',
        ));                 

        $InputType['select'] = InputType::create(array(
            'name'              => 'select',
        ));   

        $this->command->info('Input types created => next step');


        // i18n : Placeholder 1
        $i18n['placeholder'][1] = I18n::create(array(
            'i18n_type_id'      => 9 // 9 = placeholder
        ));

        // i18n : Helper 1
        $i18n['helper'][1] = I18n::create(array(
            'i18n_type_id'      => 10 // 10 = helper
        ));   

        // i18n form title
        $i18n['title'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = Title
        ));   

         // i18n form description
        $i18n['description'] = I18n::create(array(
            'i18n_type_id'      => 4 // 4 = Description
        ));      

        // Translation FR : Placeholder 1
        $translation['placeholder']['FR'][1] = Translation::create(array(
            'i18n_id'           => $i18n['placeholder'][1]->id,
            'locale_id'         => 'fr',
            'text'              => 'Complete moi stp',
        ));   

        // Translation EN : Placeholder 1
        $translation['placeholder']['EN'][1] = Translation::create(array(
            'i18n_id'           => $i18n['placeholder'][1]->id,
            'locale_id'         => 'en',
            'text'              => 'Please complete me',
        ));   

        // Translation FR : Helper 1
        $translation['helper']['FR'][1] = Translation::create(array(
            'i18n_id'           => $i18n['helper'][1]->id,
            'locale_id'         => 'fr',
            'text'              => 'Un impressionnant helper !',
        ));   

        // Translation EN : Helper 1
        $translation['helper']['EN'][1] = Translation::create(array(
            'i18n_id'           => $i18n['helper'][1]->id,
            'locale_id'         => 'en',
            'text'              => 'An awesome helper !',
        ));   

        // Translation FR : Form title
        $translation['title']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['title']->id,
            'locale_id'         => 'fr',
            'text'              => 'My awesome form',
        ));  

         // Translation EN : Form title
        $translation['title']['EN'] = Translation::create(array(
            'i18n_id'           => $i18n['title']->id,
            'locale_id'         => 'en',
            'text'              => 'My awesome form',
        ));         

        // Translation FR : Form description
        $translation['description']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['description']->id,
            'locale_id'         => 'fr',
            'text'              => 'Description of a form',
        ));  

         // Translation EN : Form description
        $translation['description']['EN'] = Translation::create(array(
            'i18n_id'           => $i18n['description']->id,
            'locale_id'         => 'en',
            'text'              => 'Description of a form',
        ));    

        $this->command->info('Translations created => next step');


        // Inputs
        $input[1] = InputView::create(array(
            'view_id'           => $view['radio']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['radio']->id,
        ));

        $input[2] = InputView::create(array(
            'view_id'           => $view['textarea']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['textarea']->id,
        ));

        $input[3] = InputView::create(array(
            'view_id'           => $view['text']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['text']->id,
        ));

        $input[4] = InputView::create(array(
            'view_id'           => $view['password']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['password']->id,
        ));

        $input[5] = InputView::create(array(
            'view_id'           => $view['hidden']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['hidden']->id,
        ));

        $input[6] = InputView::create(array(
            'view_id'           => $view['checkbox']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['checkbox']->id,
        ));

        $input[7] = InputView::create(array(
            'view_id'           => $view['submit']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['submit']->id,
        ));        

        $input[8] = InputView::create(array(
            'view_id'           => $view['select']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['select']->id,
        ));        



        $this->command->info('Inputs created => next step');


        // Form
        $form = Formr::create(array(
            'finish_on'         => 'database',
            'i18n_title'        => $i18n['title']->id,
            'i18n_description'  => $i18n['description']->id,
        ));

        $this->command->info('Form created => next step');


        // For maps
        $formMap[1] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[1]->id,
            'order'             => 1,
        ));

        $formMap[2] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[2]->id,
            'order'             => 2,
        ));

        $formMap[3] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[3]->id,
            'order'             => 3,
        ));

        $formMap[4] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[4]->id,
            'order'             => 4,
        ));

        $formMap[5] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[5]->id,
            'order'             => 5,
        ));

        $formMap[6] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[6]->id,
            'order'             => 6,
        ));

        $formMap[7] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[7]->id,
            'order'             => 7,
        ));

        $formMap[8] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[8]->id,
            'order'             => 8,
        ));



        // Text for options

        // Option 1
        $option18n[1]['key'] = I18n::create(array(
            'i18n_type_id'      => 6 // 6 = Content (temporary)
        ));      
        $option18n[1]['value'] = I18n::create(array(
            'i18n_type_id'      => 6 // 6 = Content (temporary)
        ));      


        // Option 2
        $option18n[2]['key'] = I18n::create(array(
            'i18n_type_id'      => 6 // 6 = Content (temporary)
        ));      
        $option18n[2]['value'] = I18n::create(array(
            'i18n_type_id'      => 6 // 6 = Content (temporary)
        )); 


        // Option 3
        $option18n[3]['key'] = I18n::create(array(
            'i18n_type_id'      => 6 // 6 = Content (temporary)
        ));      
        $option18n[3]['value'] = I18n::create(array(
            'i18n_type_id'      => 6 // 6 = Content (temporary)
        )); 


        // OPTION 1
        // Translation FR : option 1
        Translation::create(array(
            'i18n_id'           => $option18n[1]['key']->id,
            'locale_id'         => 'fr',
            'text'              => 'mon option 1',
        ));   
        // Translation EN : option 1
        Translation::create(array(
            'i18n_id'           => $option18n[1]['key']->id,
            'locale_id'         => 'en',
            'text'              => 'my option 1',
        ));   
        // Translation FR : option 1
        Translation::create(array(
            'i18n_id'           => $option18n[1]['value']->id,
            'locale_id'         => 'fr',
            'text'              => 'valeur ici 1',
        ));   
        // Translation EN : option 1
        Translation::create(array(
            'i18n_id'           => $option18n[1]['value']->id,
            'locale_id'         => 'en',
            'text'              => 'value here 1',
        ));   


        // OPTION 2
        // Translation FR : option 2
        Translation::create(array(
            'i18n_id'           => $option18n[2]['key']->id,
            'locale_id'         => 'fr',
            'text'              => 'Test de mon option 2',
        ));   
        // Translation EN : option 2
        Translation::create(array(
            'i18n_id'           => $option18n[2]['key']->id,
            'locale_id'         => 'en',
            'text'              => 'Test of my option 2',
        ));   
        // Translation FR : option 2
        Translation::create(array(
            'i18n_id'           => $option18n[2]['value']->id,
            'locale_id'         => 'fr',
            'text'              => 'valeur ici 2',
        ));   
        // Translation EN : option 2
        Translation::create(array(
            'i18n_id'           => $option18n[2]['value']->id,
            'locale_id'         => 'en',
            'text'              => 'value here 2',
        ));   


        // OPTION 3
        // Translation FR : option 3
        Translation::create(array(
            'i18n_id'           => $option18n[3]['key']->id,
            'locale_id'         => 'fr',
            'text'              => '3eme option',
        ));   
        // Translation EN : option 3
        Translation::create(array(
            'i18n_id'           => $option18n[3]['key']->id,
            'locale_id'         => 'en',
            'text'              => '3rd option',
        ));   
        // Translation FR : option 3
        Translation::create(array(
            'i18n_id'           => $option18n[3]['value']->id,
            'locale_id'         => 'fr',
            'text'              => 'valeur ici 3',
        ));   
        // Translation EN : option 3
        Translation::create(array(
            'i18n_id'           => $option18n[3]['value']->id,
            'locale_id'         => 'en',
            'text'              => 'value here 3',
        ));   




        // Options of select
        SelectOption::create(array(
            'input_id'          => $input[8]->id,
            'i18n_key'          => $option18n[1]['key']->id,
            'i18n_value'        => $option18n[1]['value']->id
        ));

        SelectOption::create(array(
            'input_id'          => $input[8]->id,
            'i18n_key'          => $option18n[2]['key']->id,
            'i18n_value'        => $option18n[2]['value']->id
        ));

        SelectOption::create(array(
            'input_id'          => $input[8]->id,
            'i18n_key'          => $option18n[3]['key']->id,
            'i18n_value'        => $option18n[3]['value']->id
        ));

        $this->command->info('Form maps created');

    }


}