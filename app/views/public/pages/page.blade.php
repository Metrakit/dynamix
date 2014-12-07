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

{{-- Former::create($data, 2, 2) --}}

{{-- #################### EXAMPLE #################### --}}
{{-- A test with a database finish_on (create a new table thans to the Migrator class) --}}
{{-- Former::create($data, 2, 2) --}}

{{-- #################### EXAMPLE #################### --}}
{{-- Former::renderByModel(new Gallery) --}}

{{ Pager::render($page) }}

{{-- To surcharge for comment module --}}
<hr>
<section role="comment" class="comment">
	<div class="comment-head">
		<div class="pull-left"><strong>{{ count($page->comments->all()) }} {{{ Lang::get('comment.comment'. (count($page->comments->all()) > 2 ? 's' : '' ) ) }}}</strong></div>
		<div class="pull-right">
		@if(!Auth::check())
			<a href="{{ URL::to('auth/login')}}"><strong>Login</strong></a>
		@else
			{{Auth::user()->email}}
		@endif
		</div>
		<div class="clearfix"></div>
	</div>

	@if(Auth::check())
	<div class="comment-form">
		<div class="img-comment">
			<img class="img-circle" height="48px" width="48px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( Auth::user()->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=48px"}}" alt="gravatar" />
		</div>
		<div class="input-comment-form">			
			<input type="text" placeHolder="{{{ Lang::get('comment.placeHolder') }}}" name="message">
		</div>
	</div>
	@endif

	@foreach ( $page->comments->all() as $comment ) 
	<div class="comment-user">
		<div class="img-comment">
			<img class="img-circle" height="48px" width="48px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $comment->user()->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=48px"}}" alt="gravatar" />
		</div>
		<div class="comment-user-container">
			<div class="comment-user-header">{{ $comment->user()->email }} &bull; {{ $comment->created_at->diffForHumans() }}</div>		
			{{ $comment->text }}
		</div>
	</div>
	@endforeach
	
	
</section>
@stop