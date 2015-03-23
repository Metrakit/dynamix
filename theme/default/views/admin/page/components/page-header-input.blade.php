<!-- page_title -->
<div class="page-header">
<div class="form-group {{{ $errors->has('page_title') ? 'error' : '' }}}">
    <input class="form-control input-page-lg" type="text" name="{{'page_title'}}_{{$locale_id}}" id="{{'page_title'}}_{{$locale_id}}" placeHolder="{{{ Lang::get('admin.put_page_title') }}}" value="{{{ Input::old('page_title' . '_' . $locale_id, (isset($page)?$page::getTranslation($page->structure->first()->i18n_title, $locale_id):null) ) }}}" />
    {{ $errors->first('page_title' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
</div>
</div>
<!-- ./ page_title -->