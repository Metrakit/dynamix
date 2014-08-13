@extends('public.layout.master')


@include('public.includes.meta', array( 'object' => $mosaic ))


@section('content')

<h1>{{$mosaic->title}}</h1>
@if($mosaic->description != '')
<p>{{$mosaic->description}}</p>
@endif
@foreach($mosaic->galleries as $gallery)
<div class="col-lg-3 col-md-4 col-sm-2 col-xs-6 mosaic-gallery">
    <a href="{{URL::to($gallery->url)}}"><img src="{{ $gallery->cover() }}" alt="{{$gallery->title}}" width="100%"/></a>
</div>
@endforeach
<div class="clearfix"></div>
@stop
