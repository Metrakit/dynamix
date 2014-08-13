@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.option') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/option')}}">{{{ Lang::get('admin/admin.option') }}}</a>
@stop



@section('content')
<h2>{{{ Lang::get('admin/admin.option') }}}</h2>

<form class="form-horizontal" method="post" action="{{ URL::to('admin/option') }}"  autocomplete="off">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <fieldset>

        <!-- site_url -->
        <div class="form-group {{{ $errors->has('site_url') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="site_url">Adresse du site</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="site_url" id="site_url" value="{{{ Input::old('site_url', $option->site_url) }}}" />
                {{ $errors->first('site_url', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ site_url -->

        <!-- site_name -->
        <div class="form-group {{{ $errors->has('site_name') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="site_name">Nom du site</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="site_name" id="site_name" value="{{{ Input::old('site_name', $option->site_name) }}}" />
                {{ $errors->first('site_name', '<div class="alert alert-danger">:message</div>') }}
                <p class="helpe-block">Ce texte est affiché dans l'onglet de votre site</p>
            </div>
        </div>
        <!-- ./ site_name -->

        <!-- admin_email -->
        <div class="form-group {{{ $errors->has('admin_email') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="admin_email">Mail de l'administrateur</label>
            <div class="col-sm-10">
                <input class="form-control" type="email" name="admin_email" id="admin_email" value="{{{ Input::old('admin_email', $option->admin_email) }}}" />
                {{ $errors->first('admin_email', '<div class="alert alert-danger">:message</div>') }}
                <p class="helpe-block">Ce mail sera utilisé pour recevoir les messages par le biais du formulaire de contact</p>
            </div>
        </div>
        <!-- ./ admin_email -->

        <!-- analytics -->
        <div class="form-group {{{ $errors->has('analytics') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="analytics">Code analytics</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="analytics" id="analytics" rows="10">{{{ Input::old('admin_email', $option->analytics) }}}</textarea>
                {{ $errors->first('analytics', '<div class="alert alert-danger">:message</div>') }}
                <p class="helpe-block">Outils d'analyse et de statistique placé dans le {{{'<head>'}}}.<br>Recommandé : Google Analytics (gratuit)</p>
            </div>
        </div>
        <!-- ./ analytics -->

    
        @if ( Session::get('error') )
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error') }}
        </div>
        @endif
        @if ( Session::get('notice') )
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('notice') }}
        </div>
        @endif
        @if ( Session::get('success') )
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
        </div>
        @endif

        <!-- Form Actions -->
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">{{{Lang::get('user/user.update')}}}</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </fieldset>

</form>
@stop