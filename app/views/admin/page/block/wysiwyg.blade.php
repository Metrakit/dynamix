@section('form')
<textarea class="input-block-level wysiwyg{{isset($index)?$index:''}}" name="wysiwyg_{{isset($index)?$index:''}}" value="" rows="5">{{{ Input::old('content'.(isset($index)?$index:''), null) }}}</textarea>
@stop

@section('scriptOnReady')
  console.log('start tinymce');
  tinyMCE.baseURL = "{{URL::to('/js/tinymce')}}";
  tinymce.init({
    editor_selector: ".block-locale-id-{{isset($index)?$index:''}} textarea.wysiwyg{{isset($index)?$index:''}}",theme: "modern", skin: 'light',
    plugins: [
      "table link image visualblocks code media",
      "contextmenu textcolor responsivefilemanager"
    ],
    toolbar1: "bold italic underline | forecolor backcolor table | bullist numlist | outdent indent | alignleft aligncenter alignright alignjustify | link unlink | image media | code ",

    menubar: false,
    statusbar: false,
    toolbar_item_size: "small",

    setup: function (theEditor) {


      theEditor.on('focus', function () {
          $(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").show();
      });
      theEditor.on('blur', function () {
          $(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
      });
      theEditor.on("init", function () {
          $(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
      });

    },
   
    external_filemanager_path:"/filemanager/",
    filemanager_title:"Responsive Filemanager" ,
    filemanager_access_key:"{{Config::get('app.key')}}",
    external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
    auto_focus: "wysiwyg_{{isset($index)?$index:''}}",
  });
@stop