<div class="comment-user-header">{{ $comment->user()->email }} &bull; {{ $comment->created_at->diffForHumans() }}</div>		
<div class="comment-user-body">
	<p>{{ $comment->text }}</p>
</div>
<div class="comment-user-footer">
	{{ count($comment->votes()) }} <a href="#" title="{{{ Lang::get('comment.vote_more') }}}"><span class="glyphicon glyphicon-chevron-up"></span></a>&nbsp;|
	&nbsp;<a href="#" title="{{{ Lang::get('comment.vote_more') }}}"><span class="glyphicon glyphicon-chevron-down"></span></a>
	 <span class="author-edit">&bull; <a href="#">{{{ Lang::get('comment.edit')}}}</a></span>
	 &bull; <a href="#" title="{{{ Lang::get('comment.reply') }}}">{{{ Lang::get('comment.reply') }}}</a>
</div>