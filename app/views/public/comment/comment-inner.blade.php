<div class="comment-user-header">{{ $comment->user()->email }} 
	&bull; <span class="data-created-at" data-created-at="{{$comment->created_at}}" >{{ $comment->created_at->diffForHumans() }}</span>
	{{ Form::open(array('url' => 'comment/' . $comment->id, 'class' => 'author-remove pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        <button type="submit" class="button-transparent"><span class="glyphicon glyphicon-remove"></span></button>
    {{ Form::close() }}
    <div class="clearfix"></div>
</div>		
<div class="comment-user-body">
	<p>{{ $comment->text }}</p>
</div>
<div class="comment-user-footer">
	{{ $comment->votesCount() }} <a href="#" title="{{{ Lang::get('comment.vote_more') }}}"><span class="glyphicon glyphicon-chevron-up"></span></a>&nbsp;|
	&nbsp;<a href="#" title="{{{ Lang::get('comment.vote_more') }}}"><span class="glyphicon glyphicon-chevron-down"></span></a>
	 &bull; <a href="#">{{{ Lang::get('comment.edit')}}}</a>
	 &bull; <a href="#" title="{{{ Lang::get('comment.reply') }}}">{{{ Lang::get('comment.reply') }}}</a>
</div>