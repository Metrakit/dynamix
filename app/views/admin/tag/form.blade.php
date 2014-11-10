<fieldset>
<!-- site_name -->
    <div class="form-group {{{ $errors->has('name') ? 'error' : '' }}}">
        <label class="col-md-2 control-label" for="name">{{{ Lang::get('input.name') }}}</label>
        <div class="col-md-10 col-lg-8">
    @foreach( Locale::where('enable','=',1)->get() as $lang )
            <div class="input-group">
                <div class="input-group-addon">
                    <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{$lang->flag}}" alt="{{$lang->id}}"/></span>
                </div>
                <input class="form-control" type="text" name="name_{{$lang->id}}" id="name_{{$lang->id}}" value="{{{ (isset($tag)?Input::old('site_name_'.$lang->id, $tag->site_name_locale($lang->id) ):'') }}}" />
                {{ $errors->first('site_name_'.$lang->id, '<div class="alert alert-danger">:message</div>') }}
            </div>
    @endforeach
            <p class="help-block">{{{ Lang::get('admin.tag_name_help') }}}</p>
        </div>
    </div>
    <!-- ./ site_name -->
</fieldset>