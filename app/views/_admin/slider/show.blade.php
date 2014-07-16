@extends('admin.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ $post->title }}} |
@parent
@stop


{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ asset( $post->slug ) }}">{{ $post->title }} [SHOW]</a>
@stop


{{-- Content --}}
@section('content')
@if(!empty($post))
	<section class="post">
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

		<section class="post-title">
			<div class="col-sm-3">
				<a href="{{{ $post->url() }}}" class="thumbnail"><img src="{{ (!empty($post->img)) ? asset($post->img) : 'http://placehold.it/180x180' }}" width="100%" height="100%" alt=""></a>

			</div>
			<div class="col-sm-9 post-title-col">
				<div class="post-title">
					<h1>{{$post->title}}</h1>
				</div>
			</div>
			<div class="clearfix"></div>
		</section>
		<section class="post-content">
			<div class="row">
				<p>
					{{ $post->content }}
				</p>
				<p>
					<span class="glyphicon glyphicon-user"></span> by <span class="muted">{{{ $post->author() }}}</span>
					| <span class="glyphicon glyphicon-calendar"></span>{{{ $post->date() }}}
				</p>
			</div>
			<div class="row">
				<a href="{{ URL::to('admin/post/' . $post->id . '/edit') }}" class="btn btn-warning" title="Modifier l'article"><span class="glyphicon glyphicon-pencil"></span> Modifier l'article</a>
				
				{{ Form::open(array('url' => 'admin/post/' . $post->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Supprimer l\'article', array('class' => 'btn btn-danger')) }}
				{{ Form::close() }}
			</div>
		</section>
		<section class="post-comments col-sm-9">
			<a id="comments"></a>
			<h3>{{{ $comments->count() }}} {{ \Illuminate\Support\Pluralizer::plural(Lang::get('site.comment'), $comments->count()) }}</h3>
			@if ($comments->count())
				@foreach ($comments as $comment)
				@include('admin.comments.one_comment',array('comment'=>$comment))
				<hr />
				@endforeach
			@else
				<hr />
			@endif

			@if($errors->has())
				<div class="alert alert-danger alert-block">
					<ul>
			@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
			@endforeach
					</ul>
				</div>
			@endif

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
		    
			@include('site.comments.comment-form')
		</section>
	</section>
	@else
		<p>Erreur avec l'affichage du post...</p>
	@endif
@stop