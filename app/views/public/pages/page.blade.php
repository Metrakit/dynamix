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
<?php
	//Set locale for carbon
	setlocale(LC_TIME, App::getLocale());
?>
<section role="comment" class="comment">
	<div class="comment-head">
		<div class="pull-left"><strong>{{ count($page->comments->all()) }} {{{ Lang::get('comment.comment'. (count($page->comments->all()) > 1 ? 's' : '' ) ) }}}</strong></div>
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
			<form id="comment-form" method="POST" action="{{ action('CommentController@store') }}" accept-charset="UTF-8">
    			<input type="hidden" name="_token" value="{{ csrf_token() }}">
    			<input type="hidden" name="referer" value="{{ Request::url() }}">
    			<input type="hidden" name="commentable_id" value="{{$page->id}}">
    			<input type="hidden" name="commentable_type" value="{{$page->getClassName()}}">
				<input type="text" placeHolder="{{{ Lang::get('comment.placeHolder') }}}" name="message">
			</form>
		</div>
	</div>
	@else
	<div class="alert alert-warning">
		{{{ Lang::get('auth.you_must_be_logged') }}}
	</div>
	@endif

	@include('includes.session-message-var', array('var'=>'comment'))

	@foreach ( $page->comments->all() as $comment ) 
	<div class="comment-user" data-comment-id="{{$comment->id}}">
		<div class="img-comment">
			<img class="img-circle" height="48px" width="48px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $comment->user()->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=48px"}}" alt="gravatar" />
		</div>
		<div class="comment-user-inner">
			<div class="comment-user-header">{{ $comment->user()->email }} &bull; {{ $comment->created_at->diffForHumans() }} <span class="author-edit">&bull; <a href="#" class="glyphicon glyphicon-pencil"></a></span></div>		
			<div class="comment-user-body">
				<p>{{ $comment->text }}</p>
			</div>
			<div class="comment-user-footer">
				{{ count($comment->votes()) }} <a href="#" title="{{{ Lang::get('comment.vote_more') }}}"><span class="glyphicon glyphicon-chevron-up"></span></a>&nbsp;|
				&nbsp;<a href="#" title="{{{ Lang::get('comment.vote_more') }}}"><span class="glyphicon glyphicon-chevron-down"></span></a>
				 &bull; <a href="#" title="{{{ Lang::get('comment.reply') }}}">{{{ Lang::get('comment.reply') }}}</a>
			</div>
		</div>
		@if( count($comment->children->all()) != 0)
		<ul class="comment-reply">
			@foreach( $comment->children->all() as $child )
			<li data-comment-id="{{$child->id}}">
				<div class="img-comment-reply">
					<img class="img-circle" height="36px" width="36px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $comment->user()->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=36px"}}" alt="gravatar" />
				</div>
				<div class="comment-reply-inner">
					<div class="comment-user-header">{{ $child->user()->email }} &bull; {{ $child->created_at->diffForHumans() }} <span class="author-edit">&bull; <a href="#" class="glyphicon glyphicon-pencil"></a></span></div>		
					<div class="comment-user-body">
						<p>{{ $child->text }}</p>
					</div>
					<div class="comment-user-footer">
						{{ count($child->votes()) }} <a href="#" title="{{{ Lang::get('comment.vote_more') }}}"><span class="glyphicon glyphicon-chevron-up"></span></a>&nbsp;|
						&nbsp;<a href="#" title="{{{ Lang::get('comment.vote_more') }}}"><span class="glyphicon glyphicon-chevron-down"></span></a>
						 &bull; <a href="#" title="{{{ Lang::get('comment.reply') }}}">{{{ Lang::get('comment.reply') }}}</a>
					</div>
				</div>
			</li>
			@endforeach
		</ul>
		@endif
	</div>
	@endforeach
	
	
</section>
@stop