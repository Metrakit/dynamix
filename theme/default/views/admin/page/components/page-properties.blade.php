<p class="text-right page-properties">
	<span data-toggle="collapse" data-target="#page-properties_{{$locale_id}}" aria-expanded="true"><i class="fa fa-fw fa-caret-down"></i> {{{ Lang::get('admin.page_proprieties') }}}</span>
	<span data-toggle="collapse" data-target="#page-backgrounds_{{$locale_id}}" aria-expanded="true"><i class="fa fa-fw fa-caret-down"></i> {{{ Lang::get('admin.page_backgrounds') }}}</span>
</p>

<div id="page-backgrounds_{{$locale_id}}" class="collapse">
	<h3>Background</h3>
	<div class="alert alert-info" role="alert">Le 'background' est utilisé uniquement en mode onePage</div>
	<div class="form-group {{{ $errors->has('background_type') ? 'has-error' : '' }}}">
        <label class="col-md-2 control-label" for="background_type">Type</label>
		<div class="col-md-10 col-lg-8 switch-container">
			@foreach(BackgroundType::all() as $type)
		    <div class="switch switch-inline">
		        <div class="text-capitalize switch-label">
		            {{$type->name}}
		        </div>
		        <div class="switch-button">
		            <input type="radio" id="{{$type->name}}" name="background_type" value="background_type" value="{{$type->id}}" class="cmn-toggle cmn-toggle-round-flat" {{($page->background->background_type_id==$type->id?'checked="checked"':'')}}><label for="{{$type->name}}" class="label-list"></label>
		        </div>
		        <div class="clearfix"></div>
		    </div>
		    @endforeach
		</div>
	</div>
	<div class="form-group {{{ $errors->has('background_position') ? 'has-error' : '' }}}">
        <label class="col-md-2 control-label" for="background_position">Position</label>
		<div class="col-md-10 col-lg-8 switch-container">
			@foreach(BackgroundPosition::all() as $position)
		    <div class="switch switch-inline">
		        <div class="text-capitalize switch-label">
		            {{$position->name}}
		        </div>
		        <div class="switch-button">
		            <input id="{{$position->name}}" name="background_position" value="background_position" value="{{$position->id}}" class="cmn-toggle cmn-toggle-round-flat" type="radio">
		            <label for="{{$position->name}}" class="label-list"></label>
		        </div>
		        <div class="clearfix"></div>
		    </div>
		    @endforeach
		</div>
	</div>
	<div class="form-group {{{ $errors->has('background_url') ? 'has-error' : '' }}}">
        <label class="col-md-2 control-label" for="background_url">Fichier</label>
        <div class="col-md-10 col-lg-8">
            <div class="input-group">
                <input class="form-control" type="text" name="background_url" id="background_url" value="{{{ Input::old('background_url', (isset($background) ? $background->url : '')) }}}" />
                <a class="input-group-addon btn-explore iframe-filemanager" href="{{ URL::to('filemanager/dialog.php?type=1&amp;field_id=background_url&amp;akey='.Config::get('app.key')) }}"><span>Explorer</span></a>
            </div>
            {{ $errors->first('background_url', '<div class="alert alert-danger">:message</div>') }}
            <p class="help-block">{{{Lang::get('admin.background_url')}}}</p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group color-picker {{{ $errors->has('background_color') ? 'has-error' : '' }}}">
    	<label class="col-md-2 control-label" for="background_color">Couleur</label>
	    <div class="col-md-10 col-lg-8">
            <div class="input-group">
	   			 <span class="input-group-addon"><i></i></span>
            	<input type="text" value="rgba(255,255,255,1)" class="form-control" value="{{{ Input::old('background_color', (isset($background) ? $background->background_color : '')) }}}"/>
	   		</div>
	   		{{ $errors->first('background_color', '<div class="alert alert-danger">:message</div>') }}
            <p class="help-block">{{{Lang::get('admin.background_color')}}}</p>
	   	</div>
        <div class="clearfix"></div>
	</div>
	
</div>
<hr class="page-properties-hr">
<div id="page-properties_{{$locale_id}}" class="collapse">
	<!-- page_name -->
	<div class="form-group {{{ $errors->has('page_name') ? 'error' : '' }}}">
	    <label class="col-md-2 control-label" for="{{'page_name'}}">{{{ Lang::get('admin.page_name') }}}</label>
	    <div class="col-md-10 col-lg-8">
	        <input class="form-control" type="text" name="{{'page_name'}}_{{$locale_id}}" id="{{'page_name'}}_{{$locale_id}}" value="{{{ Input::old('page_name' . '_' . $locale_id, (isset($page)?Eloquentizr::getTranslation($page->i18n_name,$locale_id):null) ) }}}" />
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
	        <input class="form-control" type="text" name="{{'page_meta_title'}}_{{$locale_id}}" id="{{'page_meta_title'}}_{{$locale_id}}" value="{{{ Input::old('page_meta_title' . '_' . $locale_id, (isset($page)?Eloquentizr::getTranslation($page->structure->first()->i18n_meta_title,$locale_id):null) ) }}}" />
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
	        <textarea class="form-control" type="text" name="{{'page_meta_description'}}_{{$locale_id}}" id="{{'page_meta_description'}}_{{$locale_id}}">{{{ Input::old('page_meta_description' . '_' . $locale_id, (isset($page)?Eloquentizr::getTranslation($page->structure->first()->i18n_meta_description,$locale_id):null) ) }}}</textarea>
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
	            <input class="form-control" type="text" name="{{'url'}}_{{$locale_id}}" id="{{'url'}}_{{$locale_id}}" value="{{{ Input::old('url' . '_' . $locale_id, (isset($page)?Eloquentizr::getTranslation($page->structure->first()->i18n_url,$locale_id):null) ) }}}" />
	            {{ $errors->first('url' . '_' . $locale_id, '<div class="alert alert-danger">:message</div>') }}
	        </div>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<!-- ./ url -->
	
	<!-- is commentable -->
	<div class="form-group {{{ $errors->has('is_commentable') ? 'has-error' : '' }}}">
        <label class="col-md-2 control-label" for="is_commentable">Activer les commentaires</label>
		<div class="col-md-10 col-lg-8 switch-container">
		    <div class="switch switch-inline">
		        <div class="switch-button">
		            <input id="is_not_commentable" name="is_commentable" value="is_commentable" class="cmn-toggle cmn-toggle-round-flat" type="checkbox" {{($page->is_commentable==1?'checked="checked"':'')}}>
		            <label for="is_not_commentable" class="label-list"></label>
		        </div>
		        <div class="clearfix"></div>
		    </div>
		</div>
	</div>
	<!-- ./ is commentable -->

	<!-- url -->
	<div class="form-group {{{ $errors->has('is_published') ? 'has-error' : '' }}}">
        <label class="col-md-2 control-label" for="is_published">Publier la page</label>
		<div class="col-md-10 col-lg-8 switch-container">
		    <div class="switch switch-inline">
		        <div class="switch-button">
		            <input id="is_not_published" name="is_published" value="is_published" class="cmn-toggle cmn-toggle-round-flat" type="checkbox" {{($page->is_published==1?'checked="checked"':'')}}>
		            <label for="is_not_published" class="label-list"></label>
		        </div>
		        <div class="clearfix"></div>
		    </div>
		</div>
	</div>
	<!-- ./ url -->
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