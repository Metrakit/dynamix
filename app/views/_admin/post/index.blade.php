@extends('admin.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('admin/blogs/blog.postIndex') }}} |
@parent
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ URL::to('admin/post') }}">Management des articles</a>
@stop

{{-- Content --}}
@section('content')

    <h1>Management des articles</h1>

    <!-- Colonne gauche -->
    <div class="col-sm-9">

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

        <section class="posts">
        <!-- Last Posts  -->
        @foreach($posts as $post)
            <hr />
            <section class="post-group">
                <div class="col-xs-3 col-md-3">
                    <a href="{{ URL::to('admin/post/'.$post->id) }}" class="thumbnail">
                    <img src="{{ (!empty($post->img)) ? asset($post->img) : 'http://placehold.it/180x180' }}" width="100%" height="100%" alt="Post image">
                    </a>
                </div>
                <div class="col-md-9">
                    <h3><a href="{{ URL::to('admin/post/'.$post->id) }}">{{ $post->title }}</a></h3>
                    <p>
                        {{ str_limit($post->content, 300) }}
                    </p>
                    <p class="right">
                        <a class="btn btn-custom" href="{{ URL::to('admin/post/'.$post->id) }}"><span class="icon-custom chevron-right-white"></span> {{{Lang::get('site.read_more')}}}</a><br>
                    </p>
                    <div>
                        {{ Form::open(array('url' => 'admin/post/' . $post->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        <div class="clearfix"></div>
                    </div>
                    <p>
                        <span class="glyphicon glyphicon-user"></span> {{{Lang::get('site.by')}}} <span class="muted">{{{ $post->author() }}}</span>
                        | <span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $post->date() }}}
                        | <span class="glyphicon glyphicon-comment"></span> <a href="{{ URL::to('admin/post/'.$post->id) }}#comments">{{$post->comments()->count()}} {{ \Illuminate\Support\Pluralizer::plural(Lang::get('site.comment'), $post->comments()->count()) }}</a>          
                    </p>
                </div>
                <div class="clearfix"></div>
            </section>
        @endforeach
        <p>{{ $posts->links() }}</p>
        <!-- ./ last post -->

        </section>

    </div>

    <!-- Colonne droite -->
    <div class="col-sm-3 right">
    
        <!-- Post Options -->
            <a href="{{URL::to('admin/post/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> {{ Lang::get('admin/blogs/blog.postName') }}</a>
            <div class="clearfix"></div>
        <!-- ./ post options -->
    </div>
    <div class="clearfix"></div>
@stop