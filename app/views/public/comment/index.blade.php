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
		@include('public.comment.comment-form', array('object' => $page))
	@else
	<div class="alert alert-warning">
		{{{ Lang::get('auth.you_must_be_logged') }}}
	</div>
	@endif

	@include('includes.session-message-var', array('var'=>'comment'))

	@foreach ( $page->comments->all() as $comment ) 
		@include('public.comment.comment', array('comment' => $comment))
	@endforeach
	
	
</section>