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
		<form class="form-horizontal" method="POST" action="{{URL::to('comment/')}}" accept-charset="UTF-8" autocomplete="off">
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
		    <input type="hidden" name="_method" value="put">
		    <fieldset>
		        <div class="form-group">
				    <textarea class="form-control" name="message" id="message"></textarea>
				    <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-ok"></span> {{{Lang::get('button.update')}}}</button>
				</div>
		    </fieldset>
		</form>
	</div>
</section>