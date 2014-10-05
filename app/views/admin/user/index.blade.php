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

@foreach($users as $u)
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    @include('admin.user.profil', array('user'=>$u))
    <div class="row">
        @if ($user->id != $u->id)
        {{ Form::open(array('url' => 'admin/user/' . $u->id, 'class' => 'pull-right')) }}
            {{ Form::hidden('_method', 'DELETE') }}
            <button type="submit" class="btn btn-xs btn-danger remove"><span class="glyphicon glyphicon-remove"></span></button>
        {{ Form::close() }}
        <a href="{{URL::to('admin/user/'.$u->id.'/edit')}}" class="btn btn-xs btn-primary pull-right"><span class="glyphicon glyphicon-lock"></span></a>
        <div class="clearfix"></div>
        @endif
    </div>
</div>
@endforeach
<div class="clearfix"></div>
@stop