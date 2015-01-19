@extends('public.layout.master')


@include('public.includes.meta', array( 'object' => $page ))

@include('public.includes.ariane', array( 'object' => $page ))


@section('content')
<div class="col-sm-9">
<form class="form-horizontal" method="POST" action="{{ URL::to('admin/comment/'.$comment->id ) }}" accept-charset="UTF-8" autocomplete="off">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="put">
    <fieldset>
        <div class="form-group {{{ $errors->has('message') ? 'has-error' : '' }}}">
		    <label class="control-label" for="message">{{{ Lang::get('input.name') }}}</label>
		    <textarea class="form-control" name="message" id="message">{{{ Input::old('message', $comment->text) }}}"</textarea>
		    {{ $errors->first('message', '<div class="alert alert-danger">:message</div>') }}
		</div>
		@include('includes.session-message')
		<div class="form-group">
		    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> {{{Lang::get('button.update')}}}</button>
		</div>
    </fieldset>
</form>
</div>
@endsection