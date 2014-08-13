@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.mosaique_edit') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/mosaique')}}">{{{ Lang::get('admin/admin.mosaique') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/mosaique/' . $mosaique->id . '/edit')}}">{{{ Lang::get('admin/admin.mosaique_edit') }}}</a>
@stop


@section('content')
<h2>{{{ Lang::get('admin/admin.mosaique_edit') }}}</h2>


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

<div class="col-sm-9">
{{ Form::model($mosaique, array('route' => array('admin.mosaique.update', $mosaique->id), 'method' => 'POST', 'files' => true, 'id' => 'mosaiqueForm', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="_method" value="put" />
        
        <fieldset>
            <div class="form-group {{{ $errors->has('meta_title') ? 'has-error' : '' }}}">
                <label class="control-label" for="meta_title">Meta Title *</label>
                <input class="form-control" type="text" name="meta_title" id="meta_title" value="{{{ Input::old('meta_title', isset($mosaique) ? $mosaique->meta_title : null) }}}" />
                {{ $errors->first('meta_title', '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">Ce texte s'affichera dans l'onglet de la mosaique</p>
            </div>

            <div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
                <label class="control-label" for="title">Titre de la mosaique *</label>
                <input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($mosaique) ? $mosaique->title : null) }}}" />
                {{ $errors->first('title', '<div class="alert alert-danger">:message</div>') }}
            </div>

            <div class="form-group {{{ $errors->has('url') ? 'has-error' : '' }}}">
                <label class="control-label" for="url">URL de la mosaique *</label>
                <div class="input-group">
                    <span class="input-group-addon">{{Config::get('app.url')}}/</span>
                    <input class="form-control" type="text" name="url" id="url" value="{{{ Input::old('url', isset($mosaique) ? substr($mosaique->url,1,strlen($mosaique->url)-1) : null) }}}" />
                </div>
                {{ $errors->first('url', '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">Attention ! Veuillez utiliser <u>uniquement</u> des caractères en minuscules et remplacez les espaces par des traits d'unions.</p>
            </div>

            <div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
                <label class="control-label" for="description">Description de la mosaique</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{{ Input::old('description', isset($mosaique) ? $mosaique->description : null) }}}</textarea>
                {{ $errors->first('description', '<div class="alert alert-danger">:message</div>') }}
            </div>

            <div class="form-group {{{ $errors->has('meta_description') ? 'has-error' : '' }}}">
                <label class="control-label" for="meta_description">Meta Description</label>
                <input class="form-control" type="text" name="meta_description" id="meta_description" value="{{{ Input::old('meta_description', isset($mosaique) ? $mosaique->meta_description : null) }}}" />
                {{ $errors->first('meta_description', '<div class="alert alert-danger">:message</div>') }}
                <p class="help-block">Ce texte est invisible par l'utilisateur mais est utilisé par le robot Google lors de l'analyse de la mosaique... Plus ce champs est riche, mieux c'est !</p>
            </div>
        </fieldset>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <!-- ./ form actions -->
{{ Form::close() }}
</div>
<div class="clearfix"></div>
@stop

@section('scriptOnReady')
CKEDITOR.replace( 'content' );
@stop