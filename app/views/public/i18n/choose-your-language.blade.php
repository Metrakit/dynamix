@extends('public.layout.master')

@section('meta_title')
Choose your language | @parent
@stop


@section('meta_description')
@stop

@section('ariane')
@parent
&nbsp;<a href="{{ URL::to( 'choose-your-language' ) }}">Choose your language</a>
@stop

@section('content')
@include('includes.session-message')




@stop