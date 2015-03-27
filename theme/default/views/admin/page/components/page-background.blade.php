<p class="text-right page-properties">
	<span data-toggle="collapse" data-target="#page-backgrounds" aria-expanded="true"><i class="fa fa-fw fa-caret-down"></i> {{{ Lang::get('admin.page_backgrounds') }}}</span>
</p>

<div id="page-backgrounds" class="collapse">
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
		            <input type="radio" id="{{$type->name}}" name="background_type" value="{{{ $type->id }}}" class="cmn-toggle cmn-toggle-round-flat" {{(!empty($page->background)?($page->background->background_type_id==$type->id?'checked="checked"':''):'')}}><label for="{{$type->name}}" class="label-list"></label>
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
		            <input id="{{$position->name}}" name="background_position" value="{{{ $position->id }}}" class="cmn-toggle cmn-toggle-round-flat" type="radio" {{(!empty($page->background)?($page->background->background_position_id==$position->id?'checked="checked"':''):'')}}>
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
                <input class="form-control" type="text" name="background_url" id="background_url" value="{{{ Input::old('background_url', (isset($page->background) ? $page->background->url : '')) }}}" />
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
            	<input type="text" value="rgba(255,255,255,1)" class="form-control" name="background_color" value="{{{ Input::old('background_color', (isset($page->background) ? $page->background->background_color : '')) }}}"/>
	   		</div>
	   		{{ $errors->first('background_color', '<div class="alert alert-danger">:message</div>') }}
            <p class="help-block">{{{Lang::get('admin.background_color')}}}</p>
	   	</div>
        <div class="clearfix"></div>
	</div>
	
</div>