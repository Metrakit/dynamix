<div class="form-group {{{ $errors->has($field_name) ? 'error' : '' }}}">
    <label class="col-md-2 control-label" for="{{$field_name}}">{{{ Lang::get('admin.' . $lang_name) }}}</label>
    <div class="col-md-10 col-lg-8">
@foreach( Locale::where('enable','=',1)->get() as $lang )
        <div class="input-group">
            <div class="input-group-addon">
                <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{$lang->flag}}" alt="{{$lang->id}}"/></span>
            </div>
            <input class="form-control" type="text" name="{{$field_name}}_{{$lang->id}}" id="{{$field_name}}_{{$lang->id}}" value="{{{ Input::old($field_name . '_' . $lang->id, (isset($object)?$object->$method_locale($lang->id):null) ) }}}" />
            {{ $errors->first($field_name . '_' . $lang->id, '<div class="alert alert-danger">:message</div>') }}
        </div>
@endforeach
        <p class="help-block">{{{ Lang::get('admin.' . $lang_name . '_help') }}}</p>
    </div>
</div>