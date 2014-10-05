@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.users') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.user_profil') }}}</h1>
    </div>
@stop

@section('content')

@include('includes.session-message')

<div class="profil">
	@include('admin.user.profil', array('user'=>$user, 'btn_name'=>	'<a href="' . URL::to('admin/user/profil/edit') . '" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>'))
</div>

@stop