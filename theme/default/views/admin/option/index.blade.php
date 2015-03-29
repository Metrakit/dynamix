@extends('theme::admin.layout.master')


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
                <input class="form-control" type="text" name="site_url" id="site_url" value="{{{ Input::old('site_url', Option::get('site_url')) }}}" />
                {{ $errors->first('site_url', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ site_url -->

        <div class="form-group {{{ $errors->has('cover_path') ? 'has-error' : '' }}}">
            <label class="col-md-2 control-label" for="cover_path">{{{Lang::get('admin.option_image')}}}</label>
            <div class="col-md-10 col-lg-8">
                <div class="input-group">
                    <input class="form-control" type="text" name="cover_path" id="cover_path" value="{{{ Input::old('cover_path', Option::get('cover_path')) }}}" />
                    <a class="input-group-addon btn-explore iframe-filemanager" href="{{ URL::to('filemanager/dialog.php?type=1&amp;field_id=cover_path&amp;akey='.Config::get('app.key')) }}"><span>Explorer</span></a>
                </div>
                {{ $errors->first('cover_path', '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{Lang::get('admin.option_image_help')}}}</p>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php
            $data_i18n = array();
            $data_i18n['field_name'] = 'site_name';
            $data_i18n['lang_name'] = 'option_site_name';
            if(isset($option)){
                $data_i18n['object'] = $option;
                $data_i18n['method_locale'] = 'site_name_locale';
            } 
        ?>
        @include('theme::admin.i18n.input_text_4form', $data_i18n)

        <?php
            $data_i18n = array();
            $data_i18n['field_name'] = 'social_title';
            $data_i18n['lang_name'] = 'option_social_title';
            if(isset($option)){
                $data_i18n['object'] = $option;
                $data_i18n['method_locale'] = 'social_title_locale';
            } 
        ?>
        @include('theme::admin.i18n.input_text_4form', $data_i18n)

        <?php
            $data_i18n = array();
            $data_i18n['field_name'] = 'social_description';
            $data_i18n['lang_name'] = 'option_social_description';
            if(isset($option)){
                $data_i18n['object'] = $option;
                $data_i18n['method_locale'] = 'social_description_locale';
            } 
        ?>
        @include('theme::admin.i18n.input_text_4form', $data_i18n)

        <!-- admin_email -->
        <div class="form-group {{{ $errors->has('admin_email') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="admin_email">{{{ Lang::get('admin.option_admin_email') }}}</label>
            <div class="col-md-10 col-lg-8">
                <input class="form-control" type="email" name="admin_email" id="admin_email" value="{{{ Input::old('admin_email', Option::get('admin_email')) }}}" />
                {{ $errors->first('admin_email', '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{ Lang::get('admin.option_admin_email_help') }}}</p>
            </div>
        </div>
        <!-- ./ admin_email -->

        <!-- theme_public -->
        <div class="form-group {{{ $errors->has('theme_public') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="theme_public">{{{ Lang::get('admin.option_theme_public') }}}</label>
            <div class="col-md-10 col-lg-8">
                <select name="theme_public" id="theme_public" class="form-control">
                  @foreach($theme_publics as $theme)
                  <option value="{{$theme->id}}"{{($theme->active?'selected="selected"':'')}}>{{$theme->name}}</option>
                  @endforeach
                </select>
                {{ $errors->first('theme_public', '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{ Lang::get('admin.option_theme_public_help') }}}</p>
            </div>
        </div>
        <!-- ./ theme_public -->
        
        <!-- theme_admin -->
        <div class="form-group {{{ $errors->has('theme_admin') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="theme_admin">{{{ Lang::get('admin.option_theme_admin') }}}</label>
            <div class="col-md-10 col-lg-8">
                <select name="theme_admin" id="theme_admin" class="form-control">
                  @foreach($theme_admins as $theme)
                  <option value="{{$theme->id}}"{{($theme->active?'selected="selected"':'')}}>{{$theme->name}}</option>
                  @endforeach
                </select>
                {{ $errors->first('theme_admin', '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{ Lang::get('admin.option_theme_admin_help') }}}</p>
            </div>
        </div>
        <!-- ./ theme_admin -->

        <!-- analytics -->
        <div class="form-group {{{ $errors->has('analytics') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="analytics">{{{ Lang::get('admin.option_analytics') }}}</label>
            <div class="col-md-10 col-lg-8">
                <textarea class="form-control" name="analytics" id="analytics" rows="10">{{{ Input::old('admin_email', Option::get('analytics')) }}}</textarea>
                {{ $errors->first('analytics', '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">{{{ Lang::get('admin.option_analytics_help') }}}<br>{{{ Lang::get('admin.option_analytics_help_recommand') }}}</p>
            </div>
        </div>
        <!-- ./ analytics -->

        @include('theme::admin.session.session-message')

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


@section('scriptOnReady')
$('.iframe-filemanager').fancybox({ 
    'width'     : 900,
    'height'    : 600,
    'type'      : 'iframe',
    'autoScale' : false
    });
@stop