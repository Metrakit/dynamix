@extends('admin.page.' . $action)

@section('form')
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
        <!-- <h3>{{{ Lang::get('admin.page_contents') }}}</h3> -->
        <div class="page-create">
            <!-- page_grid -->
            <div class="page-grid">
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="col-sm-1"><div></div></div>
                <div class="clearfix"></div>
            </div>
            <!-- ./ page_grid -->
            <!-- page_title -->
            <div class="form-group {{{ $errors->has('page_title') ? 'error' : '' }}}">
                <input class="form-control input-transparent-lg" type="text" name="{{'page_title'}}_{{$locales[$i]->id}}" id="{{'page_title'}}_{{$locales[$i]->id}}" placeHolder="{{{ Lang::get('admin.put_page_title') }}}" value="{{{ Input::old('page_title' . '_' . $locales[$i]->id, (isset($object)?$object->$method_locale($locales[$i]->id):null) ) }}}" />
                {{ $errors->first('page_title' . '_' . $locales[$i]->id, '<div class="alert alert-danger">:message</div>') }}
            </div>
            <!-- ./ page_title -->

            <div id="page-block-drawing-area" class="page-block-drawing-area row"></div>

            <div class="hidden block-presenter-call-to-create">
            @include('admin.page.block.presenter_call_to_create_in_block')
            </div>
        </div>
        
        <hr>

        <h3>{{{ Lang::get('admin.page_proprieties') }}}</h3>
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
            <label class="col-md-2 control-label" for="{{'url'}}">{{{ Lang::get('admin.page_url') }}}</label>
            <div class="col-md-10 col-lg-8">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span>{{Config::get('app.url')}}/{{$locales[$i]->id}}/</span>
                    </div>
                    <input class="form-control" type="text" name="{{'url'}}_{{$locales[$i]->id}}" id="{{'url'}}_{{$locales[$i]->id}}" value="{{{ Input::old('url' . '_' . $locales[$i]->id, (isset($object)?$object->$method_locale($locales[$i]->id):null) ) }}}" />
                    {{ $errors->first('url' . '_' . $locales[$i]->id, '<div class="alert alert-danger">:message</div>') }}
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- ./ url -->
    </div>
    @endfor
</div>

<div class="form-group">
    <button type="submit" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>

</fieldset>
@stop

@section('scriptOnReady')
$('body').on('#myTab a','click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
@stop