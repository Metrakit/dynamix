@extends('public.layout.master')

{{-- Index Title --}}
@section('title')
Page inexistante ! | 
@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')

@stop


{{-- Content --}}
@section('content')
	<h1>Ouuups !!! Cette page n'existe pas...</h1>
@stop