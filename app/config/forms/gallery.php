<?php

/**
 *
 * Configuration file of model form
 * For a good use we should respect this skelleton
 * All the inputs should be set in the display order !
 * 
 */
return array(        
    'type'  => 'normal',
    'title' => Lang::get('form.gallery.title'),
    'description' => Lang::get('form.gallery.description'),
    'data'  => array(
        'title' => array(
            'name'        => 'title',
            'type'        => 'text',
            'rules'       => 'required',
            'view'        => 3,
            'title'       => Lang::get('input.gallery.title.title'),
            'placeholder' => Lang::get('input.gallery.title.placeholder'),
            'helper'      => Lang::get('input.gallery.title.helper'),
            'label'       => Lang::get('input.gallery.title.label'),
        ),
        'description' => array(
            'name'        => 'description',
            'type'        => 'textarea',
            'rules'       => 'required',
            'view'        => 2,
            'title'       => Lang::get('input.gallery.description.title'),
            'placeholder' => Lang::get('input.gallery.description.placeholder'),
            'helper'      => Lang::get('input.gallery.description.helper'),
            'label'       => Lang::get('input.gallery.description.label'),
        ),
        'type' => array(
            'name'        => 'type',
            'type'        => 'select',
            'rules'       => 'required',
            'view'        => 8,
            'options'     => array(
                array(
                    'i18n_key'   => Lang::get('input.gallery.type.key.1'),
                    'i18n_value'   => Lang::get('input.gallery.type.value.1'),
                ),
                array(
                    'i18n_key'   => Lang::get('input.gallery.type.key.2'),
                    'i18n_value'   => Lang::get('input.gallery.type.value.2'),
                ), 
                array(
                    'i18n_key'   => Lang::get('input.gallery.type.key.3'),
                    'i18n_value'   => Lang::get('input.gallery.type.value.3'),
                ),                        
            ),
            'title'       => Lang::get('input.gallery.description.title'),
            'placeholder' => Lang::get('input.gallery.description.placeholder'),
            'helper'      => Lang::get('input.gallery.description.helper'),
            'label'       => Lang::get('input.gallery.description.label'),
        ),
    ),
    'method' => 'model',
);