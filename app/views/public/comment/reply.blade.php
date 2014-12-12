@if( count($child->children->all()) != 0)
<ul class="comment-reply">
	@foreach( $child->children->all() as $child2 )
		@include('public.comment.reply-inner', array('child' => $child2))
	@endforeach
</ul>
@endif