@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.page_create') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/page')}}">{{{ Lang::get('admin/admin.page') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/page/create')}}">{{{ Lang::get('admin/admin.page_create') }}}</a>
@stop


@section('content')
<h2>{{{ Lang::get('admin/admin.page_create') }}}</h2>


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

<div class="col-sm-9">
{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        
        @include('admin.page.page-form')

        <button type="submit" class="btn btn-primary">Créer la page !</button>
        <!-- ./ form actions -->
{{ Form::close() }}
</div>
<div class="clearfix"></div>
@stop

@section('scriptOnReady')
tinymce.init({
    selector: "textarea#content",theme: "modern",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   
   external_filemanager_path:"/relooking-coiffure/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "{{asset('filemanager/plugin.min.js')}}"}
 });
@stop