@extends('admin.layout.master')

{{-- Web site Title --}}
@section('title')
Modification de page |
@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ URL::to('admin/page/' . $page->id . '/edit') }}">{{ $page->title }} [EDIT]</a>
@stop

{{-- Content --}}

@section('content')
<div class="page-header">
	<h3>Modification de page</h3>
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

<section class="post-edit">
{{ Form::model($page, array('route' => array('admin.page.update', $page->id), 'method' => 'PUT', 'files' => true, 'id' => 'pageForm', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <!-- ./ csrf token -->
        
        @include('admin.page.page-form', array('page', ( !empty($page) ? $page : null ) ) )
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" id="cancel" class="btn">Cancel</button>
        <!-- ./ form actions -->
{{ Form::close() }}
</section>
@stop

@section('scriptOnReady')
console.log('SummerNooooote');
$('#summernote-content').summernote({
  height: 150   //set editable area's height
});
$('#summernote-footer').summernote();
@stop