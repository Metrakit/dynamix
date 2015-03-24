@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.page_create') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page_create') }}}</h1>
    </div>
@stop


@section('content')

@include('theme::admin.session.session-message')
	
	<div class="page-block-remove">
	<span class="page-lineblock-remove-btn"></span>
	<span class="page-lineblock-confirm-remove-btn"></span>
	{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-title form-horizontal', 'autocomplete' => 'off' ) ) }}
		<input type="hidden" name="show_title" id="show_title" value="1">
		<h1>{{{Lang::get('admin.page_title')}}}</h1>
	{{ Form::close() }}
	</div>

	<div id="page-template">
		@yield('template')
	</div>

	<div class="create-page">
        <h4>Ajouter des blocks</h4>
        <div class="text-center">
            @foreach( Config::get('display.page-template') as $template)
            <a href="{{ URL::to('admin/page/block/' . $template)}}" class="block-template {{$template}}"></a>
            @endforeach
        </div>
    </div>

	<p class="text-center">
		<span class="btn-submit-page btn btn-lg width100 btn-primary">{{{ Lang::get('admin.page_add') }}} <span id="progression-percent"></span></span>
	</p>

@stop