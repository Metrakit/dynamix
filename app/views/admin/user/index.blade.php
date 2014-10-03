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
        <th>{{{ Lang::get('admin.user') }}}</th>
        <th>{{{ Lang::get('user.firstname')}}}</th>
        <th>{{{ Lang::get('user.lastname')}}}</th>
        <th>{{{ Lang::get('admin.roles') }}}</th>
        <th class="text-right">{{{ Lang::get('table.actions') }}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $u)
    <tr>
        <td>
            <img class="img-circle" width="22px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $u->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=22px"}}" alt="gravatar" />
            {{$u->email . ' (' . $u->pseudo . ')'}}
        </td>
        <td class="text-capitalize">{{$u->firstname}}</td>
        <td class="text-capitalize">{{$u->lastname}}</td>
        <td class="text-capitalize">{{$u->rolesList()}}</td>
        <td>
            @if ($user->id != $u->id)
            {{ Form::open(array('url' => 'admin/user/' . $u->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                <button type="submit" class="btn btn-xs btn-danger remove"><span class="glyphicon glyphicon-remove"></span></button>
            {{ Form::close() }}
            <a href="{{URL::to('admin/user/'.$u->id.'/edit')}}" class="btn btn-xs btn-primary pull-right"><span class="glyphicon glyphicon-lock"></span></a>
            <div class="clearfix"></div>
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop