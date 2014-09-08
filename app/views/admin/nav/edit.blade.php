@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.menu_edit') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/menu')}}">{{{ Lang::get('admin/admin.menu') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/menu/' . $menu->id . '/edit')}}">{{{ Lang::get('admin/admin.menu_edit') }}}</a>
@stop


@section('content')
<h2>{{{ Lang::get('admin/admin.menu_edit') }}}</h2>

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
{{ Form::model($menu, array('route' => array('admin.menu.update', $menu->id), 'method' => 'POST', 'files' => true, 'id' => 'menuForm', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="_method" value="put" />
        
        @include('admin.menu.menu-edit-form')

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <!-- ./ form actions -->
{{ Form::close() }}
</div>
<div class="clearfix"></div>
@endsection