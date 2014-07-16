@extends('admin.layout.master')

{{-- Web site Title --}}
@section('title')
Slider |
@parent
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ URL::to('admin/slider') }}">Management des sliders</a></a>
@stop

{{-- Content --}}
@section('content')

    <h1>Management des sliders</h1>

    <!-- Colonne gauche -->
    <div class="col-sm-10">

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

        <section class="sliders">
        <!-- Last sliders  -->
        <div class="row">
        @foreach($sliders as $slider)
            <h3>Slide N&deg;{{ $slider->order }}</h3>
            <section class="slider">
                <div class="slidecontainer">
                    <div id="slideshow" class="fullwidth">
                        @include('admin.slider.one_slider', array('slider',$slider))
                    </div>
                    <img src="{{ asset('img/sources/blank.png') }}" width="100%" style="max-height:400px;">
                </div>
            </section>            
                <a href="{{ asset('admin/slider/' . $slider->id . '/edit') }}" class="btn btn-default pull-right">Modifier le slider</a>
                {{ Form::open(array('url' => 'admin/slider/' . $slider->id, 'class' => 'pull-right inlineImportant')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
        @endforeach
            <div class="clearfix"></div>
        </div>
        <!-- ./ last slider -->

        </section>

    </div>

    <!-- Colonne droite -->
    <div class="col-sm-2 right">
    
        <!-- slider Options -->
            <a href="{{URL::to('admin/slider/create')}}" class="btn btn-default pull-right"><span class="glyphicon glyphicon-plus"></span> Slider</a>
        <!-- ./ slider options -->
    </div>
    <div class="clearfix"></div>
@stop