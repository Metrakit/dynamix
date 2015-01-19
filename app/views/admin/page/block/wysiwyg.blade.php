@section('form')
<textarea class="input-block-level wysiwyg-{{isset($index)?$index:''}}" id="wysiwyg-%%-{{isset($index)?$index:''}}" name="wysiwyg_{{isset($index)?$index:''}}" value="" rows="5">{{{ Input::old('content'.(isset($index)?$index:''), null) }}}</textarea>
@stop

@section('script')
  @foreach(Cachr::getCache('DB_LocaleFrontEnable') as $locale)
  var setId{{$locale}} = function (callback) {
    console.log('start setId{{$locale}}');
    $('#tab-{{$locale}} textarea.wysiwyg-{{isset($index)?$index:''}}').attr('id',$('#tab-{{$locale}} textarea.wysiwyg-{{isset($index)?$index:''}}').attr('id').replace('%%','{{$locale}}'));
    callback();
  }

  var initTinyMCE{{$locale}} = function () {
    console.log('start initTinyMCE{{$locale}}');
    tinyMCE.baseURL = "{{URL::to('/js/tinymce')}}";
    tinymce.init({
      selector: "textarea#wysiwyg-{{$locale}}-{{isset($index)?$index:''}}",theme: "modern", skin: 'light',
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
      auto_focus: "wysiwyg-{{$current_locale}}-{{isset($index)?$index:''}}",
    });
  }
  setId{{$locale}}(initTinyMCE{{$locale}});
  @endforeach
@stop