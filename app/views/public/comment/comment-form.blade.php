<div class="comment-form">
	<div class="img-comment">
		<img class="img-circle" height="48px" width="48px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( Auth::user()->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=48px"}}" alt="gravatar" />
	</div>
	<div class="input-comment-form">
		<form id="comment-form" method="POST" action="{{ action('CommentController@store') }}" accept-charset="UTF-8">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="referer" value="{{ Request::url() }}">
			<input type="hidden" name="commentable_id" value="{{$object->id}}">
			<input type="hidden" name="commentable_type" value="{{$object->getClassName()}}">
			<input type="text" autocomplete="off" placeHolder="{{{ I18n::get('comment.placeHolder') }}}" name="message" value="">
			<button type="submit" class="btn btn-comment-form submit-comment-form pull-right">{{{ I18n::get('comment.submit') }}}</button>
		</form>
	</div>
</div>