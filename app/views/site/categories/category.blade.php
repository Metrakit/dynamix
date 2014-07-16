@extends('site.layout.master')


@include('site.includes.meta', array( 'object' => $category ))

@include('site.includes.ariane', array( 'object' => $category ))


@section('content')
<h1>{{ $category->i18n_title() }}</h1>
@foreach( $category->posts as $post)
<hr />
<section class="post-group">
	<div class="col-xs-3 col-md-3">
		<a href="{{ URL::to($post->i18n_url()) }}" class="thumbnail"><img src="{{ (!empty($post->img)) ? asset($post->img) : 'http://placehold.it/180x180' }}" width="100%" height="100%" alt="Post image"></a>
	</div>
	<div class="col-md-9">
		<h3><a href="{{ URL::to($post->i18n_url()) }}">{{ $post->i18n_title() }}</a></h3>
		<p>
			{{ str_limit( $post->i18n_content(), 300) }}
		</p>
		<p class="right">
			<a class="btn btn-custom" href="{{ URL::to($post->i18n_url()) }}"><span class="icon-custom chevron-right-white"></span> {{{Lang::get('site.read_more')}}}</a>
		</p>
		<p>
			<span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{ $post->created_at() }}
		</p>
	</div>
	<div class="clearfix"></div>
</section>
@endforeach
@stop
