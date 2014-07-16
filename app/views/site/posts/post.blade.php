@extends('site.layout.master')


@include('site.includes.meta', array( 'object' => $post ))

@include('site.includes.ariane', array( 'object' => $post ))


@section('content')
	<section class="post">
		<section class="post-title">
			<div class="col-xs-3 col-md-3">
				<a href="{{ URL::to($post->i18n_url()) }}" class="thumbnail"><img src="{{ (!empty($post->img)) ? asset($post->img) : 'http://placehold.it/180x180' }}" width="100%" height="100%" alt=""></a>
			</div>
			<div class="col-md-9 post-title-col">
				<div class="post-title">
					<h1>{{ $post->i18n_title() }}</h1>
				</div>
			</div>			
			<div class="clearfix"></div>
		</section>
		<section class="post-content">
			<p>
				{{ $post->i18n_content() }}
			</p>
			<p>
				<span class="glyphicon glyphicon-calendar"></span> {{ $post->created_at() }}
			</p>
		</section>
		<section class="post-comments col-sm-9">
			<a id="comments"></a>
			@include('site.disqus.disqus')
		</section>
	</section>
@endsection