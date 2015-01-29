@extends('public.layout.master')


@include('public.includes.meta', array( 'object' => $page ))

@include('public.includes.ariane', array( 'object' => $page ))


@section('content')
@include('includes.session-message')


{{-- Former::create($data, 2, 2) --}}

{{-- #################### EXAMPLE #################### --}}
{{-- A test with a database finish_on (create a new table thans to the Migrator class) --}}
{{-- Former::create($data, 2, 2) --}}

{{-- #################### EXAMPLE #################### --}}
{{-- Former::renderByModel(new Gallery) --}}

{{ Pager::render($page) }}

{{-- To surcharge for comment module --}}
<hr>
@include('public.comment.index', array('object' => $page))
@stop