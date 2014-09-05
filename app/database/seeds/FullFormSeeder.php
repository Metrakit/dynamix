<?php

class FullFormSeeder extends Seeder {

    // Create a View (radio)
    $view = View::create(array(
        'path'              => 'public.form.input.radio'
    ));


    $InputType['radio'] = InputType::create(array(
        'name'              => 'radio',
    ));


    // i18n : Placeholder 1
    $i18n['placeholder'][1] = I18n::create(array(
        'i18n_type_id'      => 9 // 9 = placeholder
    ));

    // i18n : Helper 1
    $i18n['helper'][1] = I18n::create(array(
        'i18n_type_id'      => 10 // 10 = helper
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







}