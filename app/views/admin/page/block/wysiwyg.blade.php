<textarea class="input-block-level tinymce-wysiwyg" name="wysiwyg_{{isset($index)?$index:''}}" value="" rows="5">{{{ Input::old('content'.(isset($index)?$index:''), null) }}}</textarea>

@section('scriptOnReady')
  tinyMCE.baseURL = "{{URL::to('/js/tinymce')}}";
  tinymce.init({
    mode : "specific_textareas",
    editor_selector : "tinymce-wysiwyg",
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
    external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
  });
@stop