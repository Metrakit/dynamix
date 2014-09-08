<fieldset>

	@if( !empty($page_not_allowed) ||  !empty($mosaique_not_allowed) )
    
    <div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
        <label class="control-label" for="title">Titre du menu *</label>
        <input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($menu) ? $menu->title : null) }}}" />
        {{ $errors->first('title', '<div class="alert alert-danger">:message</div>') }}
    </div>
	

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

    <button type="submit" class="btn btn-primary">Ajouter !</button>
    
	@else
    
	<div class="alert alert-warning alert-dismissable">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    Pour créer un menu ou un sous-menu, vous devez d'abord créer une resource (page|galerie).<br>
	</div>
    <a href="{{URL::to('admin/page/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Page</a>
    <a href="{{URL::to('admin/gallery/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Galerie</a>

    @endif
</fieldset>