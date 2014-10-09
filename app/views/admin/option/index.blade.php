@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.option') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.option') }}}</h1>
    </div>
@stop

@section('content')
<div class="row">
<form class="form-horizontal" method="post" action="{{ URL::to('admin/option') }}"  autocomplete="off">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <fieldset>

        <!-- site_url -->
        <div class="form-group {{{ $errors->has('site_url') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="site_url">{{{ Lang::get('admin.option_site_url') }}}</label>
            <div class="col-md-10 col-lg-8">
                <input class="form-control" type="text" name="site_url" id="site_url" value="{{{ Input::old('site_url', $option->site_url) }}}" />
                {{ $errors->first('site_url', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ site_url -->

        <!-- site_name -->
        <div class="form-group {{{ $errors->has('site_name') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="site_name">{{{ Lang::get('admin.option_site_name') }}}</label>
            <div class="col-md-10 col-lg-8">
        @foreach( Locale::where('enable','=',1)->get() as $lang )
                <div class="input-group">
                    <div class="input-group-addon">
                        <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{$lang->flag}}" alt="{{$lang->id}}"/></span>
                    </div>
                    <input class="form-control" type="text" name="site_name_{{$lang->id}}" id="site_name_{{$lang->id}}" value="{{{ Input::old('site_name_'.$lang->id, $option->site_name_locale($lang->id) ) }}}" />
                    {{ $errors->first('site_name_'.$lang->id, '<div class="alert alert-danger">:message</div>') }}
                </div>
        @endforeach
                <p class="help-block">{{{ Lang::get('admin.option_site_name_help') }}}</p>
            </div>
        </div>
        <!-- ./ site_name -->

        <!-- admin_email -->
        <div class="form-group {{{ $errors->has('admin_email') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="admin_email">{{{ Lang::get('admin.option_admin_email') }}}</label>
            <div class="col-md-10 col-lg-8">
                <input class="form-control" type="email" name="admin_email" id="admin_email" value="{{{ Input::old('admin_email', $option->admin_email) }}}" />
                {{ $errors->first('admin_email', '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{ Lang::get('admin.option_admin_email_help') }}}</p>
            </div>
        </div>
        <!-- ./ admin_email -->

        <!-- analytics -->
        <div class="form-group {{{ $errors->has('analytics') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="analytics">{{{ Lang::get('admin.option_analytics') }}}</label>
            <div class="col-md-10 col-lg-8">
                <textarea class="form-control" name="analytics" id="analytics" rows="10">{{{ Input::old('admin_email', $option->analytics) }}}</textarea>
                {{ $errors->first('analytics', '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{ Lang::get('admin.option_analytics_help') }}}</p>
            </div>
        </div>
        <!-- ./ analytics -->

        @include('includes.session-message')

        <!-- Form Actions -->
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10 col-lg-8">
                <button type="submit" class="btn btn-success">{{{Lang::get('button.update')}}}</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </fieldset>

</form>
</div>
@stop