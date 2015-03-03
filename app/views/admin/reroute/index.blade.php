@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.reroute') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.reroute') }}}</h1>
    </div>
@stop

@section('content')
<div class="row">
<form class="form-horizontal" method="post" action="{{ URL::to('admin/reroute') }}"  autocomplete="off">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <fieldset>

        <!-- site_url -->
        <div class="form-group {{{ $errors->has('site_url') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="site_url">{{{ Lang::get('admin.reroute_site_url') }}}</label>
            <div class="col-md-10 col-lg-8">
                <input class="form-control" type="text" name="site_url" id="site_url" value="{{{ Input::old('site_url', $option->site_url) }}}" />
                {{ $errors->first('site_url', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ site_url -->

        <?php
            $data_i18n = array();
            $data_i18n['field_name'] = 'site_name';
            $data_i18n['lang_name'] = 'option_site_name';
            if(isset($option)){
                $data_i18n['object'] = $option;
                $data_i18n['method_locale'] = 'site_name_locale';
            } 
        ?>
        @include('admin.i18n.input_text_4form', $data_i18n)

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
                <p class="help-block">{{{ Lang::get('admin.option_analytics_help') }}}<br>{{{ Lang::get('admin.option_analytics_help_recommand') }}}</p>
            </div>
        </div>
        <!-- ./ analytics -->

        @include('includes.session-message')

        <!-- Form Actions -->
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10 col-lg-8">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> {{{Lang::get('button.update')}}}</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </fieldset>

</form>
</div>
@stop