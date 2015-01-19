@extends('public.layout.onepage')


@include('public.includes.meta', array( 'object' => $onepage ))

@include('public.includes.ariane', array( 'object' => $onepage ))


@section('container')
	@include('includes.session-message')
	@foreach($onepage->parts as $part)
		<section style="background: url('{{$part->background_data()}}') no-repeat center center">
			<div class="container">
				{{$part->render()}}
			</div>
		</section>
	@endforeach
@stop