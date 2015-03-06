@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.page_edit') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page_edit') }}}</h1>
    </div>
@stop



@section('content')

@include('includes.session-message')

<form class="form-horizontal" method="post" action="{{ URL::to('admin/page') }}"  autocomplete="off">
    <input type="hidden" name="_method" value="put" />
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

    <ul class="nav nav-tabs" role="tablist" id="tab-page-edit">
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
            {{ Pager::render($page, $locales[$i]->id, true /*admin_display*/) }}
        </div>
        @endfor
    </div>

    <!-- Form Actions -->
    <div class="form-group col-md-12">
        <button type="submit" class="width100 btn btn-lg btn-primary"><span class="glyphicon glyphicon-ok"></span> {{{Lang::get('button.update')}}}</button>
    </div>
    <!-- ./ form actions -->

    </fieldset>
</form>
@stop

@section('scriptOnReady')
$('body').on('#tab-page-edit a','click', function (e) {
  e.preventDefault()
  console.log('tab');
  $(this).tab('show')
})
@stop