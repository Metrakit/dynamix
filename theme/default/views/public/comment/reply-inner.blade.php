<li class="comment-user" data-comment-id="{{$child->id}}">
	<div class="img-comment-reply">
		<img class="img-circle" height="36px" width="36px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $child->user()->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=36px"}}" alt="gravatar" />
	</div>
	<div class="comment-parent comment-reply-inner">
		@include('theme::public.comment.comment-inner', array('comment' => $child))					
	</div>
	@if( count($child->children->all()) != 0)
		@include('theme::public.comment.reply', array('child' => $child))
	@endif
</li>