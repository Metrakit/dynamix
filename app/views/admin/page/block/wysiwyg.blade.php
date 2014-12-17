@section('form')
<textarea class="input-block-level" id="wysiwyg_{{isset($index)?$index:''}}" name="wysiwyg_{{isset($index)?$index:''}}" value="" rows="5">{{{ Input::old('content'.(isset($index)?$index:''), null) }}}</textarea>
@stop

@section('scriptOnReady')
  console.log('start tinymce');
  tinyMCE.baseURL = "{{URL::to('/js/tinymce')}}";
  tinymce.init({
      selector: "textarea#wysiwyg_{{isset($index)?$index:''}}",theme: "modern",
      plugins: [
           "advlist autolink link image lists charmap print preview hr anchor pagebreak",
           "searchreplace wordcount visualblocks visualchars insertdatetime code media nonbreaking",
           "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
     ],
     toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
     toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | code ",
     image_advtab: true ,
     
     external_filemanager_path:"/filemanager/",
     filemanager_title:"Responsive Filemanager" ,
     filemanager_access_key:"{{Config::get('app.key')}}",
     external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
  });
@stop