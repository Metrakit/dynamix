@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.users') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.users') }}} 
            <a href="{{ URL::to('admin/user/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nouveau</a>
        </h1>
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
    @foreach($users as $u)
    <tr>
        <td>{{$u->lastname}}</td>
        <td>{{$u->firstname}}</td>
        <td>{{$u->pseudo}}</td>
        <td>{{$u->email}}</td>
        <td>{{$u->last_visit}}</td>
        <td>
            @if ($user->id != $u->id)
            {{ Form::open(array('url' => 'admin/user/' . $u->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                <button type="submit" class="btn btn-xs btn-danger remove"><span class="glyphicon glyphicon-remove"></span></button>
            {{ Form::close() }}
            @endif
            <a href="{{URL::to('admin/user/'.$u->id.'/edit')}}" class="btn btn-xs btn-primary pull-right"><span class="glyphicon glyphicon-lock"></span></a>
            <div class="clearfix"></div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop