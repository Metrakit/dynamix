<?php
	//Set locale for carbon
	setlocale(LC_TIME, App::getLocale());
?>
<section role="comment" class="comment">
	<div class="comment-head">
		<div class="pull-left"><strong>{{ count($object->comments->all()) }} {{{ Lang::get('comment.comment'. (count($object->comments->all()) > 1 ? 's' : '' ) ) }}}</strong></div>
		<div class="pull-right">
		@if(!Auth::check())
			<a href="{{ URL::to('auth/login')}}"><strong>{{{ Lang::get('auth.connexion')}}}</strong></a>
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
	
	<div id="comment-form-edit-hidden">
		<form class="form-horizontal comment-form-edit" method="POST" action="" accept-charset="UTF-8" autocomplete="off">
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
		    <input type="hidden" name="_method" value="put">
		    <div class="input-group">
			    <textarea class="form-control" rows="3" name="message" id="message"></textarea>
			    <div class="input-group-addon"><button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-ok"></span> {{{Lang::get('comment.edit')}}}</button></div>
		    </div>
		</form>
	</div>
	@if ( Auth::check() )
	<div id="comment-form-reply-hidden">
		<div class="comment-form-reply comment-reply">
			<div class="img-comment">
				<img class="img-circle" height="36px" width="36px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( Auth::user()->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=36px"}}" alt="gravatar" />
			</div>
			<div class="input-comment-form">
				<form class="comment-form-reply" method="POST" action="{{ action('CommentController@store') }}" accept-charset="UTF-8">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">					
					<input type="hidden" name="reply" value="1">
					<input type="hidden" name="referer" value="{{ Request::url() }}">
					<input type="hidden" name="commentable_id" value="{{$object->id}}">
					<input type="hidden" name="commentable_type" value="{{$object->getClassName()}}">
					<input type="text" autocomplete="off" placeHolder="{{{ Lang::get('comment.placeHolder') }}}" name="message" value="">
					<button type="submit" class="btn btn-comment-form submit-comment-form pull-right">{{{ Lang::get('comment.submit') }}}</button>
				</form>
			</div>
		</div>
	</div>
	@endif
</section>