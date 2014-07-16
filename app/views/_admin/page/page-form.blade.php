<fieldset>
    <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
        <label class="control-label" for="title">Titre de la page *</label>
        <input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($page) ? $page->title : null) }}}" />
        {{ $errors->first('title', '<div class="alert alert-danger">:message</div>') }}
    </div>
<!--     <div class="form-group">
        <label for="image">Illustration moyenne de la page</label>
        <input type="file" id="image" name="image">
        <p class="help-block">L'image doit être de 207px*207px minimum !</p>
    </div> -->
    <div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
        <label class="control-label" for="content">Contenu de la page *</label>
    </div>
    <textarea class="input-block-level" id="summernote-content" name="content" value="content" rows="18">{{{ Input::old('content', isset($page) ? $page->content : null) }}}
    </textarea>
    <div class="form-group {{{ $errors->has('footer') ? 'error' : '' }}}">
        <label class="control-label" for="footer">Suppléments au pied de page</label>
    </div>
    <textarea class="input-block-level" id="summernote-footer" name="footer" value="footer" rows="18">{{{ Input::old('footer', isset($page) ? $page->footer : null) }}}
    </textarea>
    <br>
    <div class="form-group {{{ $errors->has('meta-title') ? 'error' : '' }}}">
        <label class="control-label" for="meta-title">Titre de l'onglet</label>
        <input class="form-control" type="text" name="meta-title" id="meta-title" value="{{{ Input::old('meta-title', isset($page) ? $page->meta_title : null) }}}" />
        {{ $errors->first('meta-title', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group {{{ $errors->has('meta-description') ? 'error' : '' }}}">
        <label class="control-label" for="meta-description">Meta Description</label>
        <input class="form-control" type="text" name="meta-description" id="meta-description" value="{{{ Input::old('meta-description', isset($page) ? $page->meta_description : null) }}}" />
        {{ $errors->first('meta-description', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group {{{ $errors->has('meta-keywords') ? 'error' : '' }}}">
        <label class="control-label" for="meta-keywords">Meta keywords</label>
        <input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{{ Input::old('meta-keywords', isset($page) ? $page->meta_keywords : null) }}}" />
        {{ $errors->first('meta-keywords', '<div class="alert alert-danger">:message</div>') }}
    </div>
</fieldset>