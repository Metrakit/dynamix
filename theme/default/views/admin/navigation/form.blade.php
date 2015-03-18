<!-- navigation_title -->
<div class="form-group {{{ $errors->has('navigation_title') ? 'error' : '' }}}">
    <label class="col-md-2 control-label" for="navigation_title">{{{ Lang::get('admin.navigation_title') }}}</label>
    <div class="col-md-10 col-lg-8">
@foreach( Locale::where('enable','=',1)->get() as $lang )
        <div class="input-group">
            <div class="input-group-addon">
                <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{$lang->flag}}" alt="{{$lang->id}}"/></span>
            </div>
            <input class="form-control" type="text" name="navigation_title_{{$lang->id}}" id="navigation_title_{{$lang->id}}" value="{{{ Input::old('navigation_title_'.$lang->id, (isset($navigation)?$navigation->navigation_title_locale($lang->id):null) ) }}}" />
            {{ $errors->first('navigation_title_'.$lang->id, '<div class="alert alert-danger">:message</div>') }}
        </div>
@endforeach
        <p class="help-block">{{{ Lang::get('admin.navigation_title_help') }}}</p>
    </div>
</div>
<!-- ./ navigation_title -->

<!-- Resource not allowed -->
@if (Input::has('link_internal') || isset($link_internal))
<div class="form-group {{{ $errors->has('model_resource_id') ? 'has-error' : '' }}}">
    <label class="col-md-2 control-label" for="model_resource_id">Ressource interne</label>
    <div class="col-md-10 col-lg-8">
        <select class="form-control" name="model_resource_id" id="model_resource_id">
            <option value="">Choisissez une ressource</option>
            @include('theme::admin.resource.presenter_not_allowed_4form', array(  'resource_not_allowed' => $resource_not_allowed, 'selected' => array('current_resource_id' => (isset($current_resource_id)?$current_resource_id:null), 'current_resource_type' => (isset($current_resource_type)?$current_resource_type:null)) ))
        </select>
        <p class="help-block">{{{ Lang::get('admin.navigation_resource_help') }}}</p>
        {{ $errors->first('model_resource_id', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
@endif

<!-- External url -->
@if (Input::has('link_external') || isset($link_external))
<div class="form-group {{{ $errors->has('url_external') ? 'has-error' : '' }}}">
    <label class="col-md-2 control-label" for="url_external">Lien externe (url)</label>
    <div class="col-md-10 col-lg-8">
        <input class="form-control" type="text" name="url_external" id="url_external" value="{{{ Input::old('url_external', (isset($navigation)?$navigation->url():null) ) }}}" />
        <p class="help-block">{{{ Lang::get('admin.navigation_url_help')}}}</p>
        {{ $errors->first('url_external', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
@endif

@if (Input::has('parent_id'))
<input type="hidden" name="parent_id" value="{{Input::get('parent_id')}}">
@endif
@if (Input::has('order'))
<input type="hidden" name="order" value="{{Input::get('order')}}">
@endif

<div class="form-group">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>