@extends('admin.layout.master')

@section('meta_title')
{{{ Lang::get('admin.page_show') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page_show') }}}</h1>
    </div>
@stop


@section('content')

@include('includes.session-message')

<ul class="nav nav-tabs" role="tablist" id="tab-page-index">
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
        {{ Pager::render($page, $locales[$i]->id) }}
    </div>
    @endfor
</div>

</fieldset>
@stop

@section('scriptOnReady')
$('body').on('#tab-page-index a','click', function (e) {
  e.preventDefault()
  console.log('tab');
  $(this).tab('show')
})
@stop