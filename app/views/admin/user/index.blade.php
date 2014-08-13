@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.user') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/user')}}">{{{ Lang::get('admin/admin.user') }}}</a>
@stop


@section('content')
<h2>{{{ Lang::get('admin/admin.user') }}}</h2>

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

<table class="table">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Pseudo</th>
        <th>Mail</th>
        <th>Dernière visite</th>
        <th>Action</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{$user->lastname}}</td>
        <td>{{$user->firstname}}</td>
        <td>{{$user->pseudo}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->last_visit()}}</td>
        <td><a href="{{URL::to('user/'.$user->id.'/edit')}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a></td>
    </tr>
    @endforeach
</table>
 
@stop