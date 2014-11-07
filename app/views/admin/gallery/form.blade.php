<div class="form-group {{{ $errors->has('meta_title') ? 'has-error' : '' }}}">
    <label class="control-label" for="meta_title">Meta Title *</label>
    <input class="form-control" type="text" name="meta_title" id="meta_title" value="{{{ Input::old('meta_title', (isset($gallery) ? $gallery->meta_title : '')) }}}" />
    {{ $errors->first('meta_title', '<div class="alert alert-danger">:message</div>') }}
    <p class="help-block">Ce texte s'affichera dans l'onglet de la galerie</p>
</div>

<div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
    <label class="control-label" for="title">Titre de la galerie</label>
    <input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', (isset($gallery) ? $gallery->title : '')) }}}" />
    {{ $errors->first('title', '<div class="alert alert-danger">:message</div>') }}
    {{ $errors->first('url', '<div class="alert alert-danger">:message<br>Le titre est utilisé pour générer une url, vous devez changer ce titre car il existe déjà.</div>') }}
    <p class="help-block">Ex : Nom du modèl(e), Nom du produit,...</p>
</div>

<div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
    <label class="control-label" for="description">Description de la galerie</label>
    <input class="form-control" type="text" name="description" id="description" value="{{{ Input::old('description', (isset($gallery) ? $gallery->description : '')) }}}" />
    {{ $errors->first('description', '<div class="alert alert-danger">:message</div>') }}
    <p class="help-block">Ex : Contexte, Particularitées, Remarques...</p>
</div>

<div class="form-group {{{ $errors->has('cover_id') ? 'has-error' : '' }}}">
    <label class="control-label" for="cover_id">Cover de la galerie</label>
    <div class="input-group">
        <input class="form-control" type="text" name="cover_id" id="cover_id" value="{{{ Input::old('cover_id', (isset($gallery) ? $gallery->getUrlCover() : '')) }}}" />
        <a href="{{asset('filemanager/dialog.php?type=1&amp;field_id=cover_id')}}" class="input-group-addon iframe-btn btn-explore"><span>Explorer</span></a>
    </div>
    {{ $errors->first('cover_id', '<div class="alert alert-danger">:message</div>') }}
    <p class="help-block">Cette image sera utilisé comme première image de la galerie et elle sera transformé en miniature pour représenter la galerie.</p>
</div>

<div class="form-group {{{ $errors->has('mosaique_id') ? 'has-error' : '' }}}">
    <label class="control-label" for="mosaique_id">Mosaique *</label>
    <select class="form-control" name="mosaique_id" id="mosaique_id">
        <option value="">Choisissez une mosaïque..</option>
        @foreach(Cachr::getCache('DB_Mosaique') as $g)
            <option value="{{$g->id}}" {{(Input::old('mosaique_id', (isset($gallery) ? $gallery->mosaique_id : '')) == $g->id ? 'selected="selected"' : '')}}>{{$g->title}}</option>
        @endforeach
    </select>
    {{ $errors->first('mosaique_id', '<div class="alert alert-danger">:message</div>') }}
</div>

<div class="form-group {{{ $errors->has('meta_description') ? 'has-error' : '' }}}">
    <label class="control-label" for="meta_description">Meta Description</label>
    <input class="form-control" type="text" name="meta_description" id="meta_description" value="{{{ Input::old('meta_description', (isset($gallery) ? $gallery->meta_description : '')) }}}" />
    {{ $errors->first('meta_description', '<div class="alert alert-danger">:message</div>') }}
    <p class="help-block">Ce texte est invisible par l'utilisateur mais est utilisé par le robot Google lors de l'analyse de la page... Plus ce champs est riche, mieux c'est !</p>
</div>