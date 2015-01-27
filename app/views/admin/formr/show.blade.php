@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.formr') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">Affichage d'un formulaire</h1>
    </div>
@stop


@section('content')

<h3>{{ $form->title() }}</h3>

<p>{{ $form->description() }}</p>


@if(Session::has('success'))
	<success closable>
		<p>{{ Session::get('success') }}</p>
	</success>
@endif



<h4>Inputs:</h4>

{{ $displayInputs }}

<h4>Ajouter un input</h4>

{{ InputView::generateForm() }}


@stop