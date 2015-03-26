<textarea class="input-block-level ckeditor-wysiwyg" name="i18n_content_{{$blockable_id}}_{{$locale_id}}" id="i18n_content_{{$blockable_id}}_{{$locale_id}}" rows="5">{{{ Input::old('i18n_content_' . $blockable_id . '_' . $locale_id, $content) }}}</textarea>


@section ('head')
<script>
  window.CKEDITOR_BASEPATH = '/js/ckeditor/';
</script>
@stop

@section('scriptOnReady')
  $('.ckeditor-wysiwyg').each( function () {
    var id = $(this).attr('id');
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.inline( id ,{
      filebrowserBrowseUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey={{Config::get('app.key')}}',
      filebrowserUploadUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey={{Config::get('app.key')}}',
      filebrowserImageBrowseUrl : '/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey={{Config::get('app.key')}}'
    });
  });
@append