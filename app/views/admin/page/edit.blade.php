@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.page_edit') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page_edit') }}}</h1>
    </div>
@stop


@section('content')

@include('includes.session-message')

<div class="col-sm-9">
{{ Form::model($page, array('route' => array('admin.page.update', $page->id), 'method' => 'POST', 'files' => true, 'id' => 'pageForm', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="_method" value="put" />
        
        {{ Former::renderByModel($page) }}

        <button type="submit" class="btn btn-primary">Enregistrer</button>
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
   
   external_filemanager_path:"/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "{{asset('filemanager/plugin.min.js')}}"}
 });
@stop