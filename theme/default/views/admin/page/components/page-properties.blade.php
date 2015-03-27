<p class="text-right page-properties">
	<span data-toggle="collapse" data-target="#page-properties_{{$locale_id}}" aria-expanded="true"><i class="fa fa-fw fa-caret-down"></i> {{{ Lang::get('admin.page_proprieties') }}}</span>
</p>


<hr class="page-properties-hr">
<div id="page-properties_{{$locale_id}}" class="collapse">
	<!-- i18n_name -->
	<div class="form-group {{{ $errors->has('i18n_name') ? 'error' : '' }}}">
	    <label class="col-md-2 control-label" for="{{'i18n_name'}}">{{{ Lang::get('admin.i18n_name') }}}</label>
	    <div class="col-md-10 col-lg-8">
	        <input class="form-control" type="text" name="{{'i18n_name'}}_{{$locale_id}}" id="{{'i18n_name'}}_{{$locale_id}}" value="{{{ Input::old('i18n_name' . '_' . $locale_id, (isset($page)?Eloquentizr::getTranslation($page->i18n_name,$locale_id):null) ) }}}" />
	        {{ $errors->first('i18n_name' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
	        <p class="help-block">{{{ Lang::get('admin.i18n_name_help') }}}</p>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<!-- ./ i18n_name -->

	<!-- i18n_meta_title -->
	<div class="form-group {{{ $errors->has('i18n_meta_title') ? 'error' : '' }}}">
	    <label class="col-md-2 control-label" for="{{'i18n_meta_title'}}">{{{ Lang::get('admin.i18n_meta_title') }}}</label>
	    <div class="col-md-10 col-lg-8">
	        <input class="form-control" type="text" name="{{'i18n_meta_title'}}_{{$locale_id}}" id="{{'i18n_meta_title'}}_{{$locale_id}}" value="{{{ Input::old('i18n_meta_title' . '_' . $locale_id, (isset($page)?Eloquentizr::getTranslation($page->structure->first()->i18n_meta_title,$locale_id):null) ) }}}" />
	        {{ $errors->first('i18n_meta_title' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
	        <p class="help-block">{{{ Lang::get('admin.i18n_meta_title_help') }}}</p>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<!-- ./ i18n_meta_title -->

	<!-- i18n_meta_description -->
	<div class="form-group {{{ $errors->has('i18n_meta_description') ? 'error' : '' }}}">
	    <label class="col-md-2 control-label" for="{{'i18n_meta_description'}}">{{{ Lang::get('admin.i18n_meta_description') }}}</label>
	    <div class="col-md-10 col-lg-8">
	        <textarea class="form-control" type="text" name="{{'i18n_meta_description'}}_{{$locale_id}}" id="{{'i18n_meta_description'}}_{{$locale_id}}">{{{ Input::old('i18n_meta_description' . '_' . $locale_id, (isset($page)?Eloquentizr::getTranslation($page->structure->first()->i18n_meta_description,$locale_id):null) ) }}}</textarea>
	        {{ $errors->first('i18n_meta_description' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
	        <p class="help-block">{{{ Lang::get('admin.i18n_meta_description_help') }}}</p>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<!-- ./ i18n_meta_description -->

	<!-- i18n_url -->
	<div class="form-group {{{ $errors->has('i18n_url') ? 'error' : '' }}}">
	    <label class="col-md-2 control-label" for="{{'i18n_url'}}">{{{ Lang::get('admin.page_url') }}}</label>
	    <div class="col-md-10 col-lg-8">
	        <div class="input-group">
	            <div class="input-group-addon">
	                <span>{{Config::get('app.url')}}/{{$locale_id}}/</span>
	            </div>
	            <?php
	            $page_url = Eloquentizr::getTranslation($page->structure->first()->i18n_url,$locale_id);
	            ?>
	            <input class="form-control" type="text" name="{{'i18n_url'}}_{{$locale_id}}" id="{{'i18n_url'}}_{{$locale_id}}" value="{{{ Input::old('i18n_url' . '_' . $locale_id, (isset($page)?(strlen($page_url) > 0?mb_substr($page_url, 1, strlen($page_url)-1):null):null) ) }}}" />
	            {{ $errors->first('i18n_url' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
	        </div>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<!-- ./ i18n_url -->
</div>
<hr class="page-properties-hr">

@section('scriptOnReady')
$('.iframe-filemanager').fancybox({ 
    'width'     : 900,
    'height'    : 600,
    'type'      : 'iframe',
    'autoScale' : false
});
$('.color-picker').colorpicker({
	format:'rgba'
});
@stop