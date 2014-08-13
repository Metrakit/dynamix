@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.medias') }}} |
@parent
@stop


@section('filemanager')
<div class="filemanager-container">
<div class="row">
<iframe width="100%" height="100%" src="{{URL::to('filemanager/dialog.php?type=2')}}"></iframe>
</div>
</div>
@stop