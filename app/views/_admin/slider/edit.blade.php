@extends('admin.layout.master')

{{-- Web site Title --}}
@section('title')
Modification d'un slider |
@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ URL::to('admin/slider/' . $slider->id . '/edit') }}">Modification d'un slider</a>
@stop

{{-- Content --}}

@section('content')
<div class="page-header">
	<h3>Modification d'un slider</h3>
</div>

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

<section class="slider-edit">
{{ Form::model($slider, array('route' => array('admin.slider.update', $slider->id), 'method' => 'PUT', 'files' => true, 'id' => 'sliderForm', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <!-- ./ csrf token -->
        
        @include('admin.slider.slider-form', array('slider', ( !empty($slider) ? $slider : null ) ) )
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" id="cancel" class="btn">Cancel</button>
        <!-- ./ form actions -->
{{ Form::close() }}
</section>
@stop

@section('scriptOnReady')
console.log('SummerNooooote');
$('#summernote-title').summernote({
  height: 150   //set editable area's height
});
$('#summernote-description').summernote();
@stop