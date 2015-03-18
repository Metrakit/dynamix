@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.formr') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.formr') }}}
            <a href="{{ URL::route('admin.form.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nouveau</a>
        </h1>
    </div>
@stop


@section('content')

    <h1>Listing des formulaires</h1>

    <ul>
        @foreach ($forms as $form)

            <li> 
                <a href="{{ URL::route('admin.form.show', $form->id) }}">{{ $form->title() }}</a> 
                <a href="{{ URL::route('admin.form.edit', $form->id) }}"><i class="glyphicon glyphicon-pencil"></i></a> 
                {{ Form::open(array('route' => array('admin.form.destroy', $form->id), 'method' => 'delete', 'style' => 'display:inline-block;')) }}
                    <button type="submit" class="btn" style="background:transparent; padding:0;"><i class="glyphicon glyphicon-remove"></i></button>
                {{ Form::close() }}
            </li>

        @endforeach
    </ul>


@stop