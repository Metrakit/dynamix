@if( count($child->children->all()) != 0)
<ul class="comment-reply">
	<?php
		$children = $child->children()->orderBy('created_at','DESC')->get();
	?>
	@foreach( $children as $child2 )
		@include('theme::public.comment.reply-inner', array('child' => $child2))
	@endforeach
</ul>
@endif