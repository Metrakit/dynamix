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



        /**
         * 
         * Title translation
         * 
         */


        // i18n radio title
        $i18n['title']['radio'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = title
        ));      

        // Translation FR : radio title
        $translation['title']['radio']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['title']['radio']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du radion',
        ));   

        // Translation EN : radio title
        $translation['title']['radio']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['title']['radio']->id,
            'locale_id'         => 'en',
            'text'              => 'Radio title',
        ));   


        // i18n textarea title
        $i18n['title']['textarea'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = title
        ));      

        // Translation FR : textarea title
        $translation['title']['textarea']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['title']['textarea']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du Textarea',
        ));   

        // Translation EN : textarea title
        $translation['title']['textarea']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['title']['textarea']->id,
            'locale_id'         => 'en',
            'text'              => 'Textarea title',
        ));   


        // i18n text title
        $i18n['title']['text'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = title
        ));      

        // Translation FR : text title
        $translation['title']['text']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['title']['text']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du text',
        ));   

        // Translation EN : text title
        $translation['title']['text']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['title']['text']->id,
            'locale_id'         => 'en',
            'text'              => 'Text title',
        ));   


        // i18n password title
        $i18n['title']['password'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = title
        ));      

        // Translation FR : password title
        $translation['title']['password']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['title']['password']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du password',
        ));   

        // Translation EN : password title
        $translation['title']['password']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['title']['password']->id,
            'locale_id'         => 'en',
            'text'              => 'PAssword title',
        ));   


        // i18n hidden title
        $i18n['title']['hidden'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = title
        ));      

        // Translation FR : hidden title
        $translation['title']['hidden']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['title']['hidden']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du hidden',
        ));   

        // Translation EN : hidden title
        $translation['title']['hidden']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['title']['hidden']->id,
            'locale_id'         => 'en',
            'text'              => 'hidden title',
        ));   


        // i18n checkbox title
        $i18n['title']['checkbox'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = title
        ));      

        // Translation FR : checkbox title
        $translation['title']['checkbox']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['title']['checkbox']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du checkbox',
        ));   

        // Translation EN : checkbox title
        $translation['title']['checkbox']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['title']['checkbox']->id,
            'locale_id'         => 'en',
            'text'              => 'checkbox title',
        ));  


        // i18n submit title
        $i18n['title']['submit'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = title
        ));      

        // Translation FR : submit title
        $translation['title']['submit']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['title']['submit']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du submit',
        ));   

        // Translation EN : submit title
        $translation['title']['submit']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['title']['submit']->id,
            'locale_id'         => 'en',
            'text'              => 'submit title',
        ));  
        

        // i18n select title
        $i18n['title']['select'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = title
        ));      

        // Translation FR : select title
        $translation['title']['select']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['title']['select']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du select',
        ));   

        // Translation EN : select title
        $translation['title']['select']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['title']['select']->id,
            'locale_id'         => 'en',
            'text'              => 'select title',
        ));  


        /**
         *
         * label translation
         * 
         */
        
        // i18n radio label
        $i18n['label']['radio'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = label
        ));      

        // Translation FR : radio label
        $translation['label']['radio']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['label']['radio']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du radion',
        ));   

        // Translation EN : radio label
        $translation['label']['radio']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['label']['radio']->id,
            'locale_id'         => 'en',
            'text'              => 'Radio label',
        ));   


        // i18n textarea label
        $i18n['label']['textarea'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = label
        ));      

        // Translation FR : textarea label
        $translation['label']['textarea']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['label']['textarea']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du Textarea',
        ));   

        // Translation EN : textarea label
        $translation['label']['textarea']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['label']['textarea']->id,
            'locale_id'         => 'en',
            'text'              => 'Textarea label',
        ));   


        // i18n text label
        $i18n['label']['text'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = label
        ));      

        // Translation FR : text label
        $translation['label']['text']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['label']['text']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du text',
        ));   

        // Translation EN : text label
        $translation['label']['text']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['label']['text']->id,
            'locale_id'         => 'en',
            'text'              => 'Text label',
        ));   


        // i18n password label
        $i18n['label']['password'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = label
        ));      

        // Translation FR : password label
        $translation['label']['password']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['label']['password']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du password',
        ));   

        // Translation EN : password label
        $translation['label']['password']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['label']['password']->id,
            'locale_id'         => 'en',
            'text'              => 'PAssword label',
        ));   


        // i18n hidden label
        $i18n['label']['hidden'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = label
        ));      

        // Translation FR : hidden label
        $translation['label']['hidden']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['label']['hidden']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du hidden',
        ));   

        // Translation EN : hidden label
        $translation['label']['hidden']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['label']['hidden']->id,
            'locale_id'         => 'en',
            'text'              => 'hidden label',
        ));   


        // i18n checkbox label
        $i18n['label']['checkbox'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = label
        ));      

        // Translation FR : checkbox label
        $translation['label']['checkbox']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['label']['checkbox']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du checkbox',
        ));   

        // Translation EN : checkbox label
        $translation['label']['checkbox']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['label']['checkbox']->id,
            'locale_id'         => 'en',
            'text'              => 'checkbox label',
        ));  


        // i18n submit label
        $i18n['label']['submit'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = label
        ));      

        // Translation FR : submit label
        $translation['label']['submit']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['label']['submit']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du submit',
        ));   

        // Translation EN : submit label
        $translation['label']['submit']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['label']['submit']->id,
            'locale_id'         => 'en',
            'text'              => 'submit label',
        ));  
        

        // i18n select label
        $i18n['label']['select'] = I18n::create(array(
            'i18n_type_id'      => 2 // 2 = label
        ));      

        // Translation FR : select label
        $translation['label']['select']['FR'] = Translation::create(array(
            'i18n_id'           => $i18n['label']['select']->id,
            'locale_id'         => 'fr',
            'text'              => 'Titre du select',
        ));   

        // Translation EN : select label
        $translation['label']['select']['EN']= Translation::create(array(
            'i18n_id'           => $i18n['label']['select']->id,
            'locale_id'         => 'en',
            'text'              => 'select label',
        ));  
        



        // Input types
        $InputType['radio'] = InputType::create(array(
            'name'              => 'maradio',
            'rules'             => 'required',
            'i18n_title'        => $i18n['title']['radio']->id,
        ));

        $InputType['textarea'] = InputType::create(array(
            'name'              => 'monTextarea',
            'rules'             => 'required',
            'i18n_title'        => $i18n['title']['textarea']->id,
        ));

        $InputType['text'] = InputType::create(array(
            'name'              => 'blabla',
            'rules'             => 'required',
            'i18n_title'        => $i18n['title']['text']->id,
        ));     

        $InputType['password'] = InputType::create(array(
            'name'              => 'passwd',
            'rules'             => 'required',
            'i18n_title'        => $i18n['title']['password']->id,
        ));  

        $InputType['hidden'] = InputType::create(array(
            'name'              => 'testhidden',
            'rules'             => 'required',
            'defaultValue'      => 'Je suis une valeur requise',
            'i18n_title'        => $i18n['title']['hidden']->id,
        ));  

        $InputType['checkbox'] = InputType::create(array(
            'name'              => 'test',
            'rules'             => 'required',
            'i18n_title'        => $i18n['title']['checkbox']->id,
        ));  

         $InputType['submit'] = InputType::create(array(
            'name'              => 'submit',
            'rules'             => 'required',
            'i18n_title'        => $i18n['title']['submit']->id,
        ));                 

        $InputType['select'] = InputType::create(array(
            'name'              => 'aselect',
            'rules'             => 'required',
            'i18n_title'        => $i18n['title']['select']->id,
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
            'name'              => "radio",
            'view_id'           => $view['radio']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'i18n_label'        => $i18n['label']['radio']->id,
            'type_id'           => $InputType['radio']->id,
        ));

        $input[2] = InputView::create(array(
            'name'              => "textarea",
            'view_id'           => $view['textarea']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'i18n_label'        => $i18n['label']['textarea']->id,
            'type_id'           => $InputType['textarea']->id,
        ));

        $input[3] = InputView::create(array(
            'name'              => "text",
            'view_id'           => $view['text']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'i18n_label'        => $i18n['label']['text']->id,
            'type_id'           => $InputType['text']->id,
        ));

        $input[4] = InputView::create(array(
            'name'              => "password",
            'view_id'           => $view['password']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'i18n_label'        => $i18n['label']['password']->id,
            'type_id'           => $InputType['password']->id,
        ));

        $input[5] = InputView::create(array(
            'name'              => "hidden",
            'view_id'           => $view['hidden']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'i18n_label'        => $i18n['label']['hidden']->id,
            'type_id'           => $InputType['hidden']->id,
        ));

        $input[6] = InputView::create(array(
            'name'              => "checkbox",
            'view_id'           => $view['checkbox']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'i18n_label'        => $i18n['label']['checkbox']->id,
            'type_id'           => $InputType['checkbox']->id,
        ));

        $input[7] = InputView::create(array(
            'name'              => "submit",
            'view_id'           => $view['submit']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'i18n_label'        => $i18n['label']['submit']->id,
            'type_id'           => $InputType['submit']->id,
        ));        

        $input[8] = InputView::create(array(
            'name'              => "select",
            'view_id'           => $view['select']->id,
            'i18n_placeholder'  => $i18n['placeholder'][1]->id,
            'i18n_helper'       => $i18n['helper'][1]->id,
            'i18n_label'        => $i18n['label']['select']->id,
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

        $formMap[8] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[8]->id,
            'order'             => 6,
        ));

        $formMap[7] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[7]->id,
            'order'             => 7,
        ));

        $formMap[6] = FormMap::create(array(
            'form_id'           => $form->id,
            'input_id'          => $input[6]->id,
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