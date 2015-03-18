@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.i18n-constant') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.i18n-constant') }}}</h1>
    </div>
@stop

@section('content')
<div class="row">
<form class="form-horizontal" method="post" action="{{ URL::to('admin/i18n-constant') }}"  autocomplete="off">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <fieldset>
    
        <ul class="nav nav-tabs" role="tablist" id="locale-tabs">
            @for( $locales = Locale::where('enable','=',1)->get(), $countLocales = count($locales), $i = 0 ; $i < $countLocales ; $i++ )
            <li role="presentation"{{($i==0?' class="active"':'')}}>
                <a href="#tab-{{$locales[$i]->id}}" aria-controls="tab-{{$locales[$i]->id}}" role="tab" data-toggle="tab">
                    <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{$locales[$i]->flag}}" alt="{{$locales[$i]->id}}"/></span>
                </a>
            </li>
            @endfor
        </ul>

        <div class="tab-content">
        @for( $locales = Locale::where('enable','=',1)->get(), $countLocales = count($locales), $i = 0 ; $i < $countLocales ; $i++ )
            <div role="tabpanel" class="tab-pane fade{{($i==0?' in active':'')}}" id="tab-{{$locales[$i]->id}}" data-locale-id="{{$locales[$i]->id}}">
                
                @foreach( $i18nConstants as $i18n )
                <div class="form-group {{{ $errors->has('key_'.$i18n->key.'_'.$locales[$i]->id) ? 'error' : '' }}}">
                    <label class="col-md-2 control-label" for="key_{{$i18n->key}}_{{$locales[$i]->id}}">{{{ Lang::get($i18n->lang_key) }}}</label>
                    <div class="col-md-10 col-lg-8">
                        <input class="form-control" type="text" name="key_{{$i18n->key}}_{{$locales[$i]->id}}" id="key_{{$i18n->key}}_{{$locales[$i]->id}}" value="{{{ Input::old($i18n->key . '_' . $locales[$i]->id, $i18n->getLocale($locales[$i]->id) ) }}}" />
                        {{ $errors->first('key_'.$i18n->key.'_'.$locales[$i]->id, '<div class="alert alert-danger">:message</div>') }}
                    </div>
                    <div class="clearfix"></div>
                </div>
                @endforeach

            </div>
        @endfor
        </div>

        @include('theme::admin.session.session-message')

        <!-- Form Actions -->
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10 col-lg-8">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> {{{Lang::get('button.update')}}}</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </fieldset>

</form>
</div>
@stop

@section('scriptOnReady')
$('body').on('#locale-tabs a','click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
@stop