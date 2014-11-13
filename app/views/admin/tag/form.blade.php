<!-- tag_name -->
<div class="form-group {{{ $errors->has('tag_name') ? 'error' : '' }}}">
    <label class="col-md-2 control-label" for="tag_name">{{{ Lang::get('admin.tag_name') }}}</label>
    <div class="col-md-10 col-lg-8">
@foreach( Locale::where('enable','=',1)->get() as $lang )
        <div class="input-group">
            <div class="input-group-addon">
                <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{$lang->flag}}" alt="{{$lang->id}}"/></span>
            </div>
            <input class="form-control" type="text" name="tag_name_{{$lang->id}}" id="tag_name_{{$lang->id}}" value="{{{ Input::old('tag_name_'.$lang->id, (isset($tag)?$tag->tag_name_locale($lang->id):null) ) }}}" />
            {{ $errors->first('tag_name_'.$lang->id, '<div class="alert alert-danger">:message</div>') }}
        </div>
@endforeach
        <p class="help-block">{{{ Lang::get('admin.tag_name_help') }}}</p>
    </div>
</div>
<!-- ./ tag_name -->
<div class="form-group">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>