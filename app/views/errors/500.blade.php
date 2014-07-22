@extends('site.layout.master')

{{-- Index Title --}}
@section('title')
Erreur system !!!
@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')

@stop


{{-- Content --}}
@section('content')
	<h1>Ouuups !!! Une erreur s'est produite... :(</h1>
@stop