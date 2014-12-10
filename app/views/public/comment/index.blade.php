<?php
	//Set locale for carbon
	setlocale(LC_TIME, App::getLocale());
?>
<section role="comment" class="comment">
	<div class="comment-head">
		<div class="pull-left"><strong>{{ count($object->comments->all()) }} {{{ Lang::get('comment.comment'. (count($object->comments->all()) > 1 ? 's' : '' ) ) }}}</strong></div>
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
		@include('public.comment.comment-form', array('object' => $object))
	@else
	<div class="alert alert-warning">
		{{{ Lang::get('auth.you_must_be_logged') }}}
	</div>
	@endif

	@include('includes.session-message-var', array('var'=>'comment'))

	<?php
		$comments = $object->comments()->orderBy('created_at','DESC')->get();
	?>
	@if(count($comments) == 0)
	<p class="text-center"><strong>{{{ Lang::get('comment.be_the_first') }}}</strong>
	@endif

	@foreach ( $comments as $comment ) 
		@include('public.comment.comment', array('comment' => $comment))
	@endforeach
	
	
</section>