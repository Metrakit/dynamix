@section('scriptOnReady')
  tinyMCE.baseURL = "{{ URL::to('/js/tinymce') }}";
  tinymce.init({
    mode : "specific_textareas",
    editor_selector : "tinymce-wysiwyg",
    plugins: [
      "table link image visualblocks code media",
      "contextmenu textcolor responsivefilemanager",
      "preview"
    ],

    toolbar1: "bold italic underline | forecolor backcolor table | bullist numlist | outdent indent | alignleft aligncenter alignright alignjustify | link unlink | image media | code | preview",

    menubar: true,
    statusbar: false,
    toolbar_item_size: "small",

    setup: function (theEditor) {

      theEditor.on("init", function () {
          $(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").show();
      });

    },
   
    external_filemanager_path:"/filemanager/",
    filemanager_title:"Responsive Filemanager" ,
    filemanager_access_key:"{{Config::get('app.key')}}",
    external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
  });
@append

@if($input->label)

  @if($form->type != 'inline')
    <label class="@if($form->type == 'horizontal') col-sm-2 @endif control-label">{{ $input->label }}</label>
  @endif

  @if($form->type == 'horizontal')
    <div class="col-sm-6">
  @endif

@endif

@if($input->multiLang)
  @foreach($locales as $locale)

    <div class="input-group">
      <div class="input-group-addon">
          <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{ $locale->flag }}" alt="{{ $locale->id }}"/></span>
      </div>
      <textarea 
        name="{{ $input->name }}_lang_{{ $locale->id }}" 
        title="{{ $input->title }}" 
        class="form-control tinymce-wysiwyg" 
        placeholder="{{ $input->placeholder }}">{{ $input->value[$locale->id] }}</textarea>
    </div>

    @if($errors->has($input->name . '_lang_' . $locale->id)) 
          <?php $input->i18nInpError = true; ?>
          <p class="text-danger"> 
        {{ $errors->first($input->name . '_lang_' . $locale->id) }}
      </p>
    @endif

  @endforeach
@else 
  <textarea name="{{ $input->name }}" class="form-control tinymce-wysiwyg" placeholder="{{ $input->placeholder }}">{{ $input->value }}</textarea>
@endif

@if($form->type != 'inline' && !$input->i18nInpError)
  <p class="@if($errors->has($input->name)) text-danger @else help-block @endif"> 
    @if($errors->has($input->name) && !$input->multiLang) 
      {{ $errors->first($input->name) }}
    @else
      @if(isset($input->helper))
        {{ $input->helper }} 
      @endif
    @endif
  </p>
@endif

@if($form->type == 'horizontal' && $input->label)

  </div>
  <div class="clearfix"></div>

@endif