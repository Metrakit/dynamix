@extends('admin.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('admin/blogs/blog.dashboard') }}} |
@parent
@stop

{{-- Content --}}
@section('content')
    <h1>Hello {{$user->firstname()}},</h1>

    @if ( Session::get('error') )
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
    </div>
    @endif
    @if ( Session::get('notice') )
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('notice') }}
    </div>
    @endif
    @if ( Session::get('success') )
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
    </div>
    @endif

     <!-- Colonne droite -->
    <div class="col-sm-3 panel panel-default">
    <h2>{{ Lang::get('admin/blogs/blog.lastcomment') }}</h2>
        <section class="comments panel-body">
        <!-- Last Posts  -->
        @foreach($comments as $comment)
        <section class="comment">            
            <div class="col-xs-6 col-sm-12 center">
                <img class="thumbnail inlineImportant" src="http://www.gravatar.com/avatar/{{ md5( strtolower( trim( $comment->email() ) ) ) }}" width="80px" height="80px" alt="{{ $comment->author() }} Gravatar">
            </div>
            <div class="col-xs-6 col-sm-12">
                
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
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            
            <div class="col-sm-12">
                <p>{{ $comment->content }}</p>
                <p class="grey">{{Lang::get('site.by')}} {{ $comment->author() }}<br>{{ $comment->date() }}<br>
                <a href="{{ URL::to('admin/post/' . $comment->post_id) }}">> Voir le post</a></p>
            </div>
            <div class="clearfix"></div>
        </section>
        <hr>
        @endforeach
        <p><a  class="btn btn-default" href="{{ URL::to('admin/comment') }}">{{ Lang::get('admin/blogs/blog.btnallcomments') }}</a></p>
        <!-- ./ last post -->
        </section>
    </div>

    <!-- Colonne gauche -->
    <div class="col-sm-9 admin-panel panel panel-default pull-left">
        <section class="posts">
        <h2>{{ Lang::get('admin/blogs/blog.lastpost') }}</h2>
        <!-- Last Posts  -->
        <div class="panel-body">
        @foreach($posts as $post)
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="col-sm-3">
                    <a href="{{{ URL::to('admin/post/'.$post->id) }}}" class="thumbnail"><img src="{{ (!empty($post->img)) ? asset($post->img) : 'http://placehold.it/180x180' }}" width="100%" height="100%" alt=""></a>
                </div>
                <div class="col-sm-9">
                <h3><strong><a href="{{URL::to('admin/post/'.$post->id)}}">{{ $post->title }}</a></strong></h3>
                <p>
                    {{{ str_limit($post->content(),300) }}}
                </p>
                <p>
                    <span class="glyphicon glyphicon-user"></span> {{{Lang::get('site.by')}}} <span class="muted">{{{ $post->author() }}}</span>
                    | <span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $post->date() }}}
                    | <span class="glyphicon glyphicon-comment"></span> <a href="{{{ $post->url() }}}#comments">{{$post->comments()->count()}} {{ \Illuminate\Support\Pluralizer::plural(Lang::get('site.comment'), $post->comments()->count()) }}</a>                  
                </p>
                </div>
                </div>
            </div>
        @endforeach
        </div>
        <div class="right"><a href="{{URL::to('admin/post/')}}" class="btn btn-default">{{ Lang::get('admin/blogs/blog.btnallposts') }}</a></div>
        <!-- ./ last post -->

        <!-- Post Options -->
        <p>
            <a href="{{URL::to('admin/post/create')}}" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> {{ Lang::get('admin/blogs/blog.postName') }}</a>
        </p>
        <!-- ./ post options -->
        </section>
    </div>

    <!-- Colonne gauche -->
    <div class="col-sm-9 admin-panel panel panel-default pull-left">
        <section class="pages">
        <h2>Pages</h2>
        <!-- Last pages  -->
        <div class="panel-body">
        @foreach($pages as $page)
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="col-sm-12">
                <h3><strong><a href="{{URL::to('admin/page/'.$page->id)}}">{{ $page->title }}</a></strong></h3>
                <p>
                    {{{ str_limit($page->content(),300) }}}
                </p>
                </div>
                </div>
            </div>
        @endforeach
            <div class="right"><a href="{{URL::to('admin/page/')}}" class="btn btn-default">Toutes les pages</a></div>
        </div>
        <!-- ./ last post -->
        </section>
    </div>



    <div class="col-sm-9 admin-panel panel panel-default pull-left">
        <section class="register">
        <h2>{{ Lang::get('admin/blogs/blog.register') }}</h2>
        <!--  Register  -->
        @foreach($registers as $register)
        <a href="{{ URL::to('admin/register/'.$register->id) }}" class="row">
            <!-- Avatar -->
            <div class="col-xs-6 col-sm-4 center">
                <img class="thumbnail inlineImportant" src="http://www.gravatar.com/avatar/{{ md5( strtolower( trim( $register->email ) ) ) }}" alt="Gavatar">
            </div>
            <div class="col-xs-6 col-sm-4 col-sm-push-4">
                {{ Form::open(array('url' => 'admin/register/' . $register->id, 'class' => 'pull-right inlineImportant')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    <button type="submit" class="btn btn-danger">
                      <span class="glyphicon glyphicon-remove" title="Supprimer"></span>
                    </button>
                {{ Form::close() }}
            </div>
            <div class="col-xs-12 col-sm-4 col-sm-pull-4">
                <div class="col-xs-12">
                    {{$register->pseudo}}
                </div>
                <div class="col-xs-12">
                    {{$register->firstname()}}
                </div>
                <div class="col-xs-12">
                    {{$register->lastname()}}
                </div>
                <div class="col-xs-12">
                    {{$register->email}}
                </div>
            </div>
            <div class="clearfix"></div>
        </a>
        @endforeach
        <!-- ./ register -->
        </section>
    </div>
    <div class="clearfix"></div>
@stop