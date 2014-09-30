@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.users') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.users') }}}</h1>
    </div>
@stop

@section('content')

@include('includes.session-message')

<table class="table">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Pseudo</th>
        <th>Mail</th>
        <th>Dernière visite</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{$user->lastname}}</td>
        <td>{{$user->firstname}}</td>
        <td>{{$user->pseudo}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->last_visit}}</td>
        <td>
            <a href="{{URL::to('user/'.$user->id.'/edit')}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop