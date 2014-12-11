@if( count($child->children->all()) != 0)
<ul class="comment-reply">
	@foreach( $child->children->all() as $child2 )
	<li class="comment-user" data-comment-id="{{$child2->id}}">
		<div class="img-comment-reply">
			<img class="img-circle" height="36px" width="36px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $child2->user()->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=36px"}}" alt="gravatar" />
		</div>
		<div class="comment-reply-inner">
			@include('public.comment.comment-inner', array('comment' => $child2))					
		</div>
		@if( count($child2->children->all()) != 0)
			@include('public.comment.reply', array('child' => $child2))
		@endif
	</li>
	@endforeach
</ul>
@endif