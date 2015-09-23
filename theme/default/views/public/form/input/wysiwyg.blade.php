@section ('head')
<script>
  window.CKEDITOR_BASEPATH = '/js/ckeditor/';
</script>
@stop

@if($input->label)

  @if($form->type != 'inline')
    <label class="@if($form->type == 'horizontal') col-sm-2 @endif control-label">{{ $input->label }}</label>
  @endif

  @if($form->type == 'horizontal')
    <div class="col-sm-6">
  @endif

@endif

@if($input->multiLang)

    {{-- To change --}}
    <?php
      $jsToAppend = "";
      foreach($locales as $locale) {
        $jsToAppend .= " 
            CKEDITOR.replace( '" . $input->name . "_lang_" . $locale->id . "' ,{
              filebrowserBrowseUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=" . Config::get('app.key') . "',
              filebrowserUploadUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=" . Config::get('app.key') . "',
              filebrowserImageBrowseUrl : '/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=" . Config::get('app.key') . "',
              extraPlugins : 'autogrow',
              height : " . $input->height . ",
              autoGrow_minHeight : " . $input->height . ",
            }); ";
      }
    ?>

    @section('scriptOnReady')
      {{ $jsToAppend }}
    @stop

    @foreach($locales as $locale)

    <div class="input-group">
      <div class="input-group-addon">
          <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{ $locale->flag }}" alt="{{ $locale->id }}"/></span>
      </div>
      <textarea
        name="{{ $input->name }}_lang_{{ $locale->id }}" 
        title="{{ $input->title }}" 
        class="form-control ckeditor-wysiwyg" id="{{ $input->name }}_lang_{{ $locale->id }}">{{ $input->value[$locale->id] }}</textarea>
    </div>

    @if($errors->has($input->name . '_lang_' . $locale->id)) 
          <?php $input->i18nInpError = true; ?>
          <p class="text-danger"> 
        {{ $errors->first($input->name . '_lang_' . $locale->id) }}
      </p>
    @endif

  @endforeach
@else 

  @section('scriptOnReady')
      CKEDITOR.replace( '{{ $input->name }}' ,{
        filebrowserBrowseUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey={{Config::get('app.key')}}',
        filebrowserUploadUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey={{Config::get('app.key')}}',
        filebrowserImageBrowseUrl : '/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey={{Config::get('app.key')}}',
        extraPlugins : 'autogrow',
        height : {{ $input->height }},
        autoGrow_minHeight : {{ $input->height }},
      });
  @append

  <textarea name="{{ $input->name }}" class="form-control ckeditor-wysiwyg" id="{{ $input->name }}">{{ $input->value }}</textarea>
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