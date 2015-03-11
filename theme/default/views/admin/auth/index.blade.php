@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.auths') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.auths') }}}</h1>
    </div>
@stop

@section('content')

@include('admin.session.session-message')

@foreach($users as $u)

<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    @include('admin.auth.profil', array('user'=>$u, 'btn_name'=> ($user->id != $u->id?'<a href="' . URL::to('admin/role/'.$u->id.'/edit') . '"><span class="glyphicon glyphicon-lock"></span></a>':'')))
</div>
@endforeach
<div class="clearfix"></div>
</div>
@stop