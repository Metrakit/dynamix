<fieldset>
    <div class="form-group {{{ $errors->has('meta_title') ? 'has-error' : '' }}}">
        <label class="control-label" for="meta_title">Meta Title *</label>
        <input class="form-control" type="text" name="meta_title" id="meta_title" value="{{{ Input::old('meta_title', isset($page) ? $page->meta_title : null) }}}" />
        {{ $errors->first('meta_title', '<div class="alert alert-danger">:message</div>') }}
        <p class="help-block">Ce texte s'affichera dans l'onglet de la page</p>
    </div>

    <div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
        <label class="control-label" for="title">Titre de la page</label>
        <input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($page) ? $page->title : null) }}}" />
        {{ $errors->first('title', '<div class="alert alert-danger">:message</div>') }}
        <p class="help-block">Ce texte ne sera <u>pas</u> affiché ! Il sert uniquement pour l'organisation dans la partie d'administration</p>
    </div>

    @if(isset($page))
    @if($page->url != '/')
    <div class="form-group {{{ $errors->has('url') ? 'has-error' : '' }}}">
        <label class="control-label" for="url">URL de la page *</label>
        <div class="input-group">
            <span class="input-group-addon">{{Config::get('app.url')}}/</span>
            <input class="form-control" type="text" name="url" id="url" value="{{{ Input::old('url', isset($page) ? substr($page->url,1,strlen($page->url)-1) : null) }}}" />
        </div>
        {{ $errors->first('url', '<div class="alert alert-danger">:message</div>') }}
        <p class="help-block">Attention ! Veuillez utiliser <u>uniquement</u> des caractères en minuscules et remplacez les espaces par des traits d'unions.</p>
    </div>
    @endif
    @else
    <div class="form-group {{{ $errors->has('url') ? 'has-error' : '' }}}">
        <label class="control-label" for="url">URL de la page *</label>
        <div class="input-group">
            <span class="input-group-addon">{{Config::get('app.url')}}/</span>
            <input class="form-control" type="text" name="url" id="url" value="{{{ Input::old('url', isset($page) ? substr($page->url,1,strlen($page->url)-1) : null) }}}" />
        </div>
        {{ $errors->first('url', '<div class="alert alert-danger">:message</div>') }}
        <p class="help-block">Attention ! Veuillez utiliser <u>uniquement</u> des caractères en minuscules et remplacez les espaces par des traits d'unions.</p>
    </div>
    @endif

    <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
        <label class="control-label" for="content">Contenu de la page *</label>
    </div>

    <textarea class="input-block-level" id="content" name="content" value="content" rows="18">{{{ Input::old('content', isset($page) ? $page->content : null) }}}
    </textarea>

    <br>

    <div class="form-group {{{ $errors->has('meta_description') ? 'has-error' : '' }}}">
        <label class="control-label" for="meta_description">Meta Description</label>
        <input class="form-control" type="text" name="meta_description" id="meta_description" value="{{{ Input::old('meta_description', isset($page) ? $page->meta_description : null) }}}" />
        {{ $errors->first('meta_description', '<div class="alert alert-danger">:message</div>') }}
        <p class="help-block">Ce texte est invisible par l'utilisateur mais est utilisé par le robot Google lors de l'analyse de la page... Plus ce champs est riche, mieux c'est !</p>
    </div>
</fieldset>