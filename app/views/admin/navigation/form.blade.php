<!-- tag_title -->
<div class="form-group {{{ $errors->has('tag_title') ? 'error' : '' }}}">
    <label class="col-md-2 control-label" for="tag_title">{{{ Lang::get('admin.tag_title') }}}</label>
    <div class="col-md-10 col-lg-8">
@foreach( Locale::where('enable','=',1)->get() as $lang )
        <div class="input-group">
            <div class="input-group-addon">
                <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{$lang->flag}}" alt="{{$lang->id}}"/></span>
            </div>
            <input class="form-control" type="text" name="tag_title_{{$lang->id}}" id="tag_title_{{$lang->id}}" value="{{{ Input::old('tag_title_'.$lang->id, (isset($tag)?$tag->tag_title_locale($lang->id):null) ) }}}" />
            {{ $errors->first('tag_title_'.$lang->id, '<div class="alert alert-danger">:message</div>') }}
        </div>
@endforeach
        <p class="help-block">{{{ Lang::get('admin.tag_title_help') }}}</p>
    </div>
</div>
<!-- ./ tag_title -->

<div class="form-group {{{ $errors->has('resource_id_n_element_id') ? 'has-error' : '' }}}">
    <label class="control-label" for="resource_id_n_element_id">Ressource / Type</label>
    <select class="form-control" name="resource_id_n_element_id" id="resource_id_n_element_id">
        <option value="">Choisissez une ressource ou un type</option>
        @if(!empty($page_not_allowed))
        <optgroup label="Page"> 
            @foreach($page_not_allowed as $pna)
                <option value="{{Resource::where('name','=','page')->first()->id}}|{{$pna->id}}">{{$pna->title}}</option>
            @endforeach
        </optgroup>
        @endif
        @if(!empty($mosaique_not_allowed))
        <optgroup label="Galerie">
            @foreach($mosaique_not_allowed as $gna)
                <option value="{{Resource::where('name','=','mosaique')->first()->id}}|{{$gna->id}}">{{$gna->title}}</option>
            @endforeach
        </optgroup>
        @endif
        @if( !isset($parent_id) )
        <optgroup label="Type">
            <option value="{{Resource::where('name','=','linkcontainer')->first()->id}}|null">Conteneur de sous-menu</option>
        </optgroup>
        @endif
    </select>
    <p class="help-text">Vous devez choisir une des options ci-dessus elle servira à faire le lien entre le menu et la page, galerie..<br><br>Les resources, sont les pages et galeries que vous aurez créé.<br>Le type, Conteneur de sous-menu, permet de faire un menu avec des sous-menus. C'est la base de l'architecture.</p>
    {{ $errors->first('resource_id_n_element_id', '<div class="alert alert-danger">:message</div>') }}
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>