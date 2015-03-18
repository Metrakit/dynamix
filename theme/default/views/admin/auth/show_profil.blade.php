@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.auths') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.auth_profil') }}}</h1>
    </div>
@stop

@section('content')

@include('theme::admin.session.session-message')

<div class="profil">
	@include('theme::admin.auth.profil', array('user'=>$user, 'btn_name'=>	'<a href="' . URL::to('admin/profil/edit') . '"><span class="glyphicon glyphicon-pencil"></span></a>'))
</div>

@stop