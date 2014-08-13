@extends('public.layout.master')


@include('public.includes.meta', array( 'object' => $gallery ))

@include('public.includes.ariane', array( 'object' => $gallery ))


@section('scriptOnReady')
    $( '#cbp-fwslider' ).cbpFWSlider();
@stop


@section('slides')
    <div id="cbp-fwslider" class="cbp-fwslider">
    	<div class="cbp-fwslider-info">
	    	<h3>{{$gallery->title}}</h3>
	    	<p>
	    		{{$gallery->description}}
	    		<br class="hidden-sm hidden-xs"><br class="hidden-sm hidden-xs"><span class="link hidden-sm hidden-xs"><a href="{{URL::to('/')}}">Accueil</a>&nbsp;>&nbsp;<a href="{{URL::to($gallery->mosaique->url)}}">Galerie {{$gallery->mosaique->title}}</a></span>
	    	</p>
    	</div>
        <ul>
        @foreach($images as $image)
            <li data-thumb="{{ $image->getThumb() }}"><a href="#"><img u="image" src="{{$image->getImage() }}" /></a></li>
        @endforeach
        </ul>
    </div>
@stop