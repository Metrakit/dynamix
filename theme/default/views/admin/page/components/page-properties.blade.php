<p class="text-right page-properties">
	<span data-toggle="collapse" data-target="#page-properties_{{$locale_id}}" aria-expanded="true"><i class="fa fa-fw fa-caret-down"></i> {{{ Lang::get('admin.page_proprieties') }}}</span>
	<span data-toggle="collapse" data-target="#page-backgrounds_{{$locale_id}}" aria-expanded="true"><i class="fa fa-fw fa-caret-down"></i> {{{ Lang::get('admin.page_backgrounds') }}}</span>
</p>

<div id="page-backgrounds_{{$locale_id}}" class="collapse">
	<div class="form-group {{{ $errors->has('cover_path') ? 'has-error' : '' }}}">
        <label class="col-md-2 control-label" for="cover_path">{{{Lang::get('admin.option_image')}}}</label>
        <div class="col-md-10 col-lg-8">
            <div class="input-group">
                <input class="form-control" type="text" name="cover_path" id="cover_path" value="{{{ Input::old('cover_path', (isset($option) ? $option->cover_path : '')) }}}" />
                <a class="input-group-addon btn-explore iframe-filemanager" href="{{ URL::to('filemanager/dialog.php?type=1&amp;field_id=cover_path&amp;akey='.Config::get('app.key')) }}"><span>Explorer</span></a>
            </div>
            {{ $errors->first('cover_path', '<div class="alert alert-danger">:message</div>') }}
            <p class="help-block">{{{Lang::get('admin.option_image_help')}}}</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div id="page-properties_{{$locale_id}}" class="collapse">
	<!-- page_name -->
	<div class="form-group {{{ $errors->has('page_name') ? 'error' : '' }}}">
	    <label class="col-md-2 control-label" for="{{'page_name'}}">{{{ Lang::get('admin.page_name') }}}</label>
	    <div class="col-md-10 col-lg-8">
	        <input class="form-control" type="text" name="{{'page_name'}}_{{$locale_id}}" id="{{'page_name'}}_{{$locale_id}}" value="{{{ Input::old('page_name' . '_' . $locale_id, (isset($object)?$object->$method_locale($locale_id):null) ) }}}" />
	        {{ $errors->first('page_name' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
	        <p class="help-block">{{{ Lang::get('admin.page_name_help') }}}</p>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<!-- ./ page_name -->

	<!-- page_meta_title -->
	<div class="form-group {{{ $errors->has('page_meta_title') ? 'error' : '' }}}">
	    <label class="col-md-2 control-label" for="{{'page_meta_title'}}">{{{ Lang::get('admin.page_meta_title') }}}</label>
	    <div class="col-md-10 col-lg-8">
	        <input class="form-control" type="text" name="{{'page_meta_title'}}_{{$locale_id}}" id="{{'page_meta_title'}}_{{$locale_id}}" value="{{{ Input::old('page_meta_title' . '_' . $locale_id, (isset($object)?$object->$method_locale($locale_id):null) ) }}}" />
	        {{ $errors->first('page_meta_title' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
	        <p class="help-block">{{{ Lang::get('admin.page_meta_title_help') }}}</p>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<!-- ./ page_meta_title -->

	<!-- page_meta_description -->
	<div class="form-group {{{ $errors->has('page_meta_description') ? 'error' : '' }}}">
	    <label class="col-md-2 control-label" for="{{'page_meta_description'}}">{{{ Lang::get('admin.page_meta_description') }}}</label>
	    <div class="col-md-10 col-lg-8">
	        <textarea class="form-control" type="text" name="{{'page_meta_description'}}_{{$locale_id}}" id="{{'page_meta_description'}}_{{$locale_id}}">{{{ Input::old('page_meta_description' . '_' . $locale_id, (isset($object)?$object->$method_locale($locale_id):null) ) }}}</textarea>
	        {{ $errors->first('page_meta_description' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
	        <p class="help-block">{{{ Lang::get('admin.page_meta_description_help') }}}</p>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<!-- ./ page_meta_description -->

	<!-- url -->
	<div class="form-group {{{ $errors->has('url') ? 'error' : '' }}}">
	    <label class="col-md-2 control-label" for="{{'url'}}">{{{ Lang::get('admin.page_url') }}}</label>
	    <div class="col-md-10 col-lg-8">
	        <div class="input-group">
	            <div class="input-group-addon">
	                <span>{{Config::get('app.url')}}/{{$locale_id}}/</span>
	            </div>
	            <input class="form-control" type="text" name="{{'url'}}_{{$locale_id}}" id="{{'url'}}_{{$locale_id}}" value="{{{ Input::old('url' . '_' . $locale_id, (isset($object)?$object->$method_locale($locale_id):null) ) }}}" />
	            {{ $errors->first('url' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
	        </div>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<!-- ./ url -->
</div>


@section('scriptOnReady')
$('.iframe-filemanager').fancybox({ 
    'width'     : 900,
    'height'    : 600,
    'type'      : 'iframe',
    'autoScale' : false
    });
@stop