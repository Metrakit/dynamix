<section class="comment">
	<div class="col-xs-4 col-sm-2 img_min">
		<img src="http://www.gravatar.com/avatar/{{ md5( strtolower( trim( $comment->email() ) ) ) }}" width="80px" height="80px" alt="{{ $comment->author() }} Gravatar">
	</div>
	<div class="col-xs-8 col-sm-10">
		<div class="row">
			<div>
				<span><strong>{{{ $comment->author() }}}</strong></span><span class="grey"> {{{ $comment->date() }}}</span>
			</div>
			<div class="comment-content">
				{{ $comment->content() }}
                    @if($comment->isConfirm)
                    <div class="btn btn-info pull-right inlineImportant">
                        <span class="glyphicon glyphicon-cloud" title="En ligne"></span>
                    </div>
                    {{ Form::open(array('url' => 'admin/comment/' . $comment->id, 'class' => 'pull-right inlineImportant')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        <button type="submit" class="btn btn-danger">
                          <span class="glyphicon glyphicon-remove" title="Supprimer"></span>
                        </button>
                    {{ Form::close() }}
                    @else
                    {{ Form::open(array('url' => 'admin/comment/' . $comment->id . '/confirm', 'class' => 'pull-right inlineImportant', 'method' => 'post')) }}
                        <button type="submit" class="btn btn-success">
                          <span class="glyphicon glyphicon-ok" title="Mettre en ligne"></span>
                        </button>
                    {{ Form::close() }}
                    {{ Form::open(array('url' => 'admin/comment/' . $comment->id, 'class' => 'pull-right inlineImportant')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        <button type="submit" class="btn btn-danger">
                          <span class="glyphicon glyphicon-remove" title="Supprimer"></span>
                        </button>
                    {{ Form::close() }}
                    @endif
				<p>
                    <a href="{{ URL::to('admin/post/' . $comment->post_id) }}">> Voir le post</a>
                </p>
            </div>
        </div>
    </div>
	<div class="clearfix"></div>
</section>