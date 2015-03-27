<!-- i18n_title -->
<div class="page-header padding-0 margin-top-0">
<div class="{{{ $errors->has('i18n_title') ? 'error' : '' }}}">
    <input class="form-control input-page-lg" type="text" name="{{'i18n_title'}}_{{$locale_id}}" id="{{'i18n_title'}}_{{$locale_id}}" placeHolder="{{{ Lang::get('admin.page_title') }}}" value="{{{ Input::old('i18n_title' . '_' . $locale_id, (isset($page)?$page::getTranslation($page->structure->first()->i18n_title, $locale_id):null) ) }}}" />
    {{ $errors->first('i18n_title' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
</div>
</div>
<!-- ./ i18n_title -->