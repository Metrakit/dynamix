@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.page_create') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page_create') }}}</h1>
    </div>
@stop


@section('content')

@include('includes.session-message')

<div class="col-sm-9">
{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

        @include('admin.page.form')

        <button type="submit" class="btn btn-primary">Créer la page !</button>
        <!-- ./ form actions -->
{{ Form::close() }}
</div>
<div class="clearfix"></div>
@stop

@section('scriptOnReady')
tinyMCE.baseURL = "{{Url::to('/js/tinymce')}}";
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
   filemanager_access_key:"{{Config::get('app.key')}}",
   external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
});

$('body').on('#myTab a','click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
@stop