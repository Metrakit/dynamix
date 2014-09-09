<?php

class FullFormSeeder extends Seeder {


    public function run()
    {
        // Create a View (radio)
        $view = Viewr::create(array(
            'path'              => 'public.form.input.radio',
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
            'view_id'           => $view->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['radio']->id,
        ));

        $input[2] = InputView::create(array(
            'view_id'           => $view->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['textarea']->id,
        ));

        $input[3] = InputView::create(array(
            'view_id'           => $view->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['text']->id,
        ));

        $input[4] = InputView::create(array(
            'view_id'           => $view->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'type_id'           => $InputType['password']->id,
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


        $this->command->info('Form maps created');

    }


}