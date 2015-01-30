@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.auth_edit_profil') }}} |
@parent
@stop




@section('content')
 @include('tasks.list', array('tasks', $tasks))
@stop