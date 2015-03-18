@extends('theme::admin.page.' . $action)

@section('form')
<ul class="nav nav-tabs" role="tablist" id="myTab">
    @for( $locales = Locale::where('enable','=',1)->get(), $countLocales = count($locales), $i = 0 ; $i < $countLocales ; $i++ )
    <li role="presentation"{{($i==0?' class="active"':'')}}>
        <a href="#tab-{{$locales[$i]->id}}" aria-controls="tab-{{$locales[$i]->id}}" role="tab" data-toggle="tab">
            <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{$locales[$i]->flag}}" alt="{{$locales[$i]->id}}"/></span>
        </a>
    </li>
    @endfor
</ul>

<fieldset>



<div class="tab-content">
    @for( $locales = Locale::where('enable','=',1)->get(), $countLocales = count($locales), $i = 0 ; $i < $countLocales ; $i++ )
    <div role="tabpanel" class="tab-pane fade{{($i==0?' in active':'')}}" id="tab-{{$locales[$i]->id}}" data-locale-id="{{$locales[$i]->id}}">
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

            <div id="page-block-drawing-area-{{$locales[$i]->id}}" class="page-block-drawing-area row"></div>

            <div class="hidden block-presenter-call-to-create">
            <div class="handful handful-left"></div>
            @include('theme::admin.page.block.presenter_call_to_create_in_block')
            <div class="handful handful-right"></div>
            </div>
        </div>
        
        <hr>


        <!-- ./ url -->
    </div>
    @endfor
</div>

<div class="form-group text-center">
    <button type="submit" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>

</fieldset>
@stop

@section('scriptOnReady')
$('body').on('#myTab a','click', function (e) {
  e.preventDefault()
  console.log('tab');
  $(this).tab('show')
})
@stop