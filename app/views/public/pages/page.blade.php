@extends('public.layout.master')


@include('public.includes.meta', array( 'object' => $page ))

@include('public.includes.ariane', array( 'object' => $page ))


@section('content')
@include('includes.session-message')




<?php
	$data = array(        
	    'type'  => 'normal',
	    'method' => 'database',

	    'title' => array(
        	'fr'		=> '',
        	'en'		=> '',
        ),

	    'description' => array(
        	'fr'		=> '',
        	'en'		=> '',
        ),

	    'data'  => array(
	        'title' => array(
	            'name'        => 'title',
	            'type'        => 'text',
	            'rules'       => 'required',
	            'view'        => 3,
	            'title'       => array(
	            	'fr'		=> 'untesttitle',
	            	'en'		=> 'atesttitle',
	            ),
	            'placeholder' => array(
	            	'fr'		=> 'untestplaceholder',
	            	'en'		=> 'atestplaceholder',
	            ),
	            'helper'      => array(
	            	'fr'		=> 'untesthelper',
	            	'en'		=> 'atesthelper',
	            ),
	            'label'       => array(
	            	'fr'		=> 'untestlabel',
	            	'en'		=> 'atestlabel',
	            ),
	        ),

	        'description' => array(
	            'name'        => 'description',
	            'type'        => 'textarea',
	            'rules'       => 'required',
	            'view'        => 2,
	            'title'       => array(
	            	'fr'		=> 'descriptiondetestfr',
	            	'en'		=> 'testdescriptionen',
	            ),
	            'placeholder' => array(
	            	'fr'		=> 'placeholdertestfr',
	            	'en'		=> 'placeholdertesten',
	            ),
	            'helper'      => array(
	            	'fr'		=> 'helperde test fr',
	            	'en'		=> '',
	            ),
	            'label'       => array(
	            	'fr'		=> '',
	            	'en'		=> '',
	            ),
	        ),

	        'type' => array(
	            'name'        => 'type',
	            'type'        => 'select',
	            'rules'       => 'required',
	            'view'        => 8,
	            'options'     => array(
	                array(
	                	'key'   => array(
			            	'fr'		=> 'TestfrKey1',
			            	'en'		=> 'TestenKey1',
			            ),
	                    'value'   => array(
			            	'fr'		=> 'TestfrValue1',
			            	'en'		=> 'TestfrValue1',
			            ),
	                ),
	                array(
	                    'key'   => array(
			            	'fr'		=> 'Testfrkey2',
			            	'en'		=> 'Testenkey2',
			            ),
			            'value'   => array(
			            	'fr'		=> 'TestfrValue2',
			            	'en'		=> 'TestenValue2',
			            ),
	                ), 
	                array(
	                    'key'   => array(
			            	'fr'		=> 'TestfrKey3',
			            	'en'		=> 'TestenKey3',
			            ),
			            'value'   => array(
			            	'fr'		=> 'TestfrValue3',
			            	'en'		=> 'TestenValue3',
			            ),
	                ),                        
	            ),
	            'title' 	  => array(
	            	'fr'		=> 'titretestfr',
	            	'en'		=> 'titretesten',
	            ),
	            'placeholder' => array(
	            	'fr'		=> 'placeholdertestfr',
	            	'en'		=> 'placeholdertesten',
	            ),
	            'helper'      => array(
	            	'fr'		=> 'helpertestfr',
	            	'en'		=> 'helpertesten',
	            ),
	            'label'       => array(
	            	'fr'		=> 'labeltestfr',
	            	'en'		=> 'labeltesten',
	            ),
	        ),

	        'envoyer' => array(
	            'name'        => 'envoyer',
	            'type'        => 'submit',
	            'rules'       => 'required',
	            'view'        => 7,
	            'title'       => array(
	            	'fr'		=> '',
	            	'en'		=> '',
	            ),
	            'placeholder' => array(
	            	'fr'		=> '',
	            	'en'		=> '',
	            ),
	            'helper'      => array(
	            	'fr'		=> '',
	            	'en'		=> '',
	            ),
	            'label'       => array(
	            	'fr'		=> '',
	            	'en'		=> '',
	            ),
	        ),
	    ),

	);

?>

{{-- Former::create(2, 2, $data) --}}

{{-- #################### EXAMPLE #################### --}}
{{-- EXAMPLE OF CREATE A FORM BY A MODEL --}}
{{  Former::create(2, 2, new Gallery) }}
{{-- #################### EXAMPLE #################### --}}




{{ Pager::render($page) }}

@stop