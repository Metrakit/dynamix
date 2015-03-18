<div class="comment-user" data-comment-id="{{$comment->id}}">
	<div class="img-comment">
		<img class="img-circle" height="48px" width="48px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $comment->user()->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=48px"}}" alt="gravatar" />
	</div>
	<div class="comment-parent comment-user-inner">
		@include('theme::public.comment.comment-inner', array('comment' => $comment))		
	</div>
	@include('theme::public.comment.reply', array('child' => $comment))
</div>