@extends('admin.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ $page->title }}} |
@parent
@stop


{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ asset( $page->slug ) }}">{{ $page->title }} [SHOW]</a>
@stop


{{-- Content --}}
@section('content')
@if(!empty($page))
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

		<h1>{{$page->title}}</h1>
		<section class="post-content">
			<div class="row">
				<p>
					{{ $page->content }}
				</p>
			</div>
			<div class="row">
				<a href="{{ URL::to('admin/page/' . $page->id . '/edit') }}" class="btn btn-warning" title="Modifier la page"><span class="glyphicon glyphicon-pencil"></span> Modifier la page</a>
				
				{{ Form::open(array('url' => 'admin/page/' . $page->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Supprimer la page', array('class' => 'btn btn-danger')) }}
				{{ Form::close() }}
			</div>
		</section>
		<section class="post-comments">
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