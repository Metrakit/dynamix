<fieldset>

    <div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
        <label class="control-label" for="title">Titre du menu *</label>
        <input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($menu) ? $menu->title : null) }}}" />
        {{ $errors->first('title', '<div class="alert alert-danger">:message</div>') }}
    </div>

    <div class="form-group {{{ $errors->has('resource_id_n_element_id') ? 'has-error' : '' }}}">
        <label class="control-label" for="resource_id_n_element_id">Ressource / Type</label>
        <select class="form-control" name="resource_id_n_element_id" id="resource_id_n_element_id" {{ ( count( $menu->children() ) != 0 || $menu->parent_id != 0 ? 'disabled="disabled"' : '' ) }}>
			<option value="">Choisissez une ressource ou un type</option>
        	@if(!empty($page_not_allowed))
			<optgroup label="Page"> 
		      	@foreach($page_not_allowed as $pna)
					<option value="{{Resource::where('name','=','page')->first()->id}}|{{$pna->id}}" {{( $menu->resource_id == Resource::where('name','=','page')->first()->id && $menu->element_id == $pna->id ? 'selected="selected"' : '' )}}>{{$pna->title}}</option>
		      	@endforeach
		  	</optgroup>
		  	@endif
		  	@if(!empty($mosaique_not_allowed))
			<optgroup label="Galerie">
		      	@foreach($mosaique_not_allowed as $gna)
					<option value="{{Resource::where('name','=','mosaique')->first()->id}}|{{$gna->id}}"{{( $menu->resource_id == Resource::where('name','=','mosaique')->first()->id && $menu->element_id == $gna->id ? 'selected="selected"' : '' )}}>{{$gna->title}}</option>
		      	@endforeach
		  	</optgroup>
			<optgroup label="Type">
				<option value="{{Resource::where('name','=','linkcontainer')->first()->id}}|null"{{( $menu->resource_id == Resource::where('name','=','linkcontainer')->first()->id && $menu->element_id == null ? 'selected="selected"' : '' )}}>Conteneur de sous-menu</option>
			</optgroup>
		  	@endif
        </select>
        <p class="help-text">Vous devez choisir une des options ci-dessus elle servira à faire le lien entre le menu et la page, galerie..<br><br>Les resources, sont les pages et galeries que vous aurez créé.<br>Le type, Conteneur de sous-menu, permet de faire un menu avec des sous-menus. C'est la base de l'architecture.</p>
        {{ $errors->first('resource_id_n_element_id', '<div class="alert alert-danger">:message</div>') }}
    </div>

</fieldset>