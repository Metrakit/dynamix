@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.user_edit_profil') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.user_edit_profil') }}}</h1>
    </div>
@stop

@section('content')
<div class="col-sm-9">
<form class="form-horizontal" method="POST" action="{{ URL::to('admin/user/profil/edit' ) }}" accept-charset="UTF-8" autocomplete="off">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
        @include('admin.user.form_profil')
    </fieldset>
</form>
</div>
@stop