<div class="comment-user-header">{{ $comment->user()->email }} 
	&bull; <span class="data-created-at" data-created-at="{{$comment->created_at}}" >{{ $comment->created_at->diffForHumans() }}</span>
	@if (Auth::check())
	@if ($comment->user_id == Auth::user()->id)
	{{ Form::open(array('url' => 'comment/' . $comment->id, 'class' => 'author-remove pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        <button type="submit" class="button-transparent"><span class="glyphicon glyphicon-remove"></span></button>
    {{ Form::close() }}
    @endif
    @endif
    <div class="clearfix"></div>
</div>		
<div class="comment-user-body">
	<p>{{ $comment->text }}</p>
</div>
<div class="comment-user-footer">
	<span class="vote-counter vote-counter-up">{{ $comment->votesPositives() }}</span>
	{{ Form::open(array('url' => 'comment/' . $comment->id . '/vote/1', 'class' => 'comment-vote comment-vote-up display-inline-block')) }}
        <button type="submit" class="button-transparent" title="{{{ I18n::get('comment.vote_up') }}}"><span class="comment-vote-up glyphicon glyphicon-chevron-up {{(Auth::check()?($comment->userHasVotePositive(Auth::user()->id)?'color-blue':''):'')}}"></span></button>
    {{ Form::close() }}
     | 
    <span class="vote-counter vote-counter-down">{{ $comment->votesNegatives() }}</span>
    {{ Form::open(array('url' => 'comment/' . $comment->id . '/vote/0', 'class' => 'comment-vote comment-vote-down display-inline-block')) }}
        <button type="submit" class="button-transparent" title="{{{ I18n::get('comment.vote_down') }}}"><span class="comment-vote-down glyphicon glyphicon-chevron-down {{(Auth::check()?($comment->userHasVoteNegative(Auth::user()->id)?'color-red':''):'')}}"></span></button>
    {{ Form::close() }}
    @if (Auth::check())
    @if ($comment->user_id == Auth::user()->id)
	 &bull; <a class="comment-edit" href="{{ URL::to('comment/' . $comment->id) }}">{{{ I18n::get('comment.edit')}}}</a>
    @endif
    @endif
	 &bull; <a class="comment-add-reply" href="#" title="{{{ I18n::get('comment.reply') }}}">{{{ I18n::get('comment.reply') }}}</a>
</div>