@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.menu_new_create') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/menu')}}">{{{ Lang::get('admin/admin.menu') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/menu/create')}}">{{{ Lang::get('admin/admin.menu_new_create') }}}</a>
@stop


@section('content')
<h2>{{{ Lang::get('admin/admin.menu_new_create') }}}</h2>

@if ( Session::get('error') )
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('error') }}
</div>
@endif
@if ( Session::get('notice') )
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('notice') }}
</div>
@endif
@if ( Session::get('success') )
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('success') }}
</div>
@endif

<div class="col-sm-9">
{{ Form::open(array('url' => URL::to('admin/menu/create-new-menu'), 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="order" value="{{ Input::get('order') }}" />
        
        @include('admin.menu.menu-create-form')

        <!-- ./ form actions -->
{{ Form::close() }}
</div>
<div class="clearfix"></div>
@endsection