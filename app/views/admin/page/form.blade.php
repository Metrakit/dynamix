<ul class="nav nav-tabs" role="tablist" id="myTab">
    @for( $locales = Locale::where('enable','=',1)->get(), $countLocales = count($locales), $i = 0 ; $i < $countLocales ; $i++ )
    <li role="presentation"{{($i==0?' class="active"':'')}}>
        <a href="#{{$locales[$i]->id}}" aria-controls="{{$locales[$i]->id}}" role="tab" data-toggle="tab">
            <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{$locales[$i]->flag}}" alt="{{$locales[$i]->id}}"/></span>
        </a>
    </li>
    @endfor
</ul>

<fieldset>

<div class="tab-content">
    @for( $locales = Locale::where('enable','=',1)->get(), $countLocales = count($locales), $i = 0 ; $i < $countLocales ; $i++ )
    <div role="tabpanel" class="tab-pane fade{{($i==0?' in active':'')}}" id="{{$locales[$i]->id}}">
        <!-- page_name -->
        <div class="form-group {{{ $errors->has('page_name') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="{{'page_name'}}">{{{ Lang::get('admin.page_name') }}}</label>
            <div class="col-md-10 col-lg-8">
                <input class="form-control" type="text" name="{{'page_name'}}_{{$locales[$i]->id}}" id="{{'page_name'}}_{{$locales[$i]->id}}" value="{{{ Input::old('page_name' . '_' . $locales[$i]->id, (isset($object)?$object->$method_locale($locales[$i]->id):null) ) }}}" />
                {{ $errors->first('page_name' . '_' . $locales[$i]->id, '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{ Lang::get('admin.page_name_help') }}}</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- ./ page_name -->

        <!-- page_title -->
        <div class="form-group {{{ $errors->has('page_title') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="{{'page_title'}}">{{{ Lang::get('admin.page_title') }}}</label>
            <div class="col-md-10 col-lg-8">
                <input class="form-control" type="text" name="{{'page_title'}}_{{$locales[$i]->id}}" id="{{'page_title'}}_{{$locales[$i]->id}}" value="{{{ Input::old('page_title' . '_' . $locales[$i]->id, (isset($object)?$object->$method_locale($locales[$i]->id):null) ) }}}" />
                {{ $errors->first('page_title' . '_' . $locales[$i]->id, '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{ Lang::get('admin.page_title_help') }}}</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- ./ page_title -->

        <!-- page_meta_title -->
        <div class="form-group {{{ $errors->has('page_meta_title') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="{{'page_meta_title'}}">{{{ Lang::get('admin.page_meta_title') }}}</label>
            <div class="col-md-10 col-lg-8">
                <input class="form-control" type="text" name="{{'page_meta_title'}}_{{$locales[$i]->id}}" id="{{'page_meta_title'}}_{{$locales[$i]->id}}" value="{{{ Input::old('page_meta_title' . '_' . $locales[$i]->id, (isset($object)?$object->$method_locale($locales[$i]->id):null) ) }}}" />
                {{ $errors->first('page_meta_title' . '_' . $locales[$i]->id, '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{ Lang::get('admin.page_meta_title_help') }}}</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- ./ page_meta_title -->

        <!-- page_meta_description -->
        <div class="form-group {{{ $errors->has('page_meta_description') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="{{'page_meta_description'}}">{{{ Lang::get('admin.page_meta_description') }}}</label>
            <div class="col-md-10 col-lg-8">
                <textarea class="form-control" type="text" name="{{'page_meta_description'}}_{{$locales[$i]->id}}" id="{{'page_meta_description'}}_{{$locales[$i]->id}}">{{{ Input::old('page_meta_description' . '_' . $locales[$i]->id, (isset($object)?$object->$method_locale($locales[$i]->id):null) ) }}}</textarea>
                {{ $errors->first('page_meta_description' . '_' . $locales[$i]->id, '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{ Lang::get('admin.page_meta_description_help') }}}</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- ./ page_meta_description -->

        <!-- url -->
        <div class="form-group {{{ $errors->has('url') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="{{'url'}}">{{{ Lang::get('admin.url') }}}</label>
            <div class="col-md-10 col-lg-8">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span>{{Config::get('app.url')}}/{{$locales[$i]->id}}/</span>
                    </div>
                    <input class="form-control" type="text" name="{{'url'}}_{{$locales[$i]->id}}" id="{{'url'}}_{{$locales[$i]->id}}" value="{{{ Input::old('url' . '_' . $locales[$i]->id, (isset($object)?$object->$method_locale($locales[$i]->id):null) ) }}}" />
                    {{ $errors->first('url' . '_' . $locales[$i]->id, '<div class="alert alert-danger">:message</div>') }}
                </div>
                <p class="help-block">{{{ Lang::get('admin.url_help') }}}</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- ./ url -->

        <!-- création de block -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="#">{{{ Lang::get('admin.block_create') }}}</label>
        </div>
        <!-- ./ création de block -->
    </div>
    @endfor
</div>

</fieldset>
   <!--  <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
       <label class="col-md-2 control-label" for="content">Contenu de la page *</label>
       <div class="col-md-8">
           <textarea class="input-block-level" id="content" name="content" value="content" rows="18">{{{ Input::old('content', isset($page) ? $page->content : null) }}}
           </textarea>
       </div>
   </div> -->