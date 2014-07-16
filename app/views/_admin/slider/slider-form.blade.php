<fieldset>
    <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
        <label class="control-label" for="title">Titre du slide (facultatif)</label>
    </div>
    <textarea class="input-block-level" id="summernote-title" name="title" value="title" rows="18">{{{ Input::old('title', isset($slider) ? $slider->title : null) }}}
    </textarea>
    {{ $errors->first('title', '<div class="alert alert-danger">:message</div>') }}<br>

    <div class="form-group">
        <label for="image">Image du slide *</label>
        <input type="file" id="image" name="image">
        <p class="help-block">L'image doit être précisément de 920*400px !</p>
        {{ $errors->first('image', '<div class="alert alert-danger">:message</div>') }}
    </div>

    <div class="form-group {{{ $errors->has('img_alt') ? 'error' : '' }}}">
        <label class="control-label" for="img_alt">Alternative Image *</label>
        <input class="form-control" type="text" name="img_alt" id="img_alt" value="{{{ Input::old('img_alt', isset($slider) ? $slider->img_alt : null) }}}" />
        {{ $errors->first('img_alt', '<div class="alert alert-danger">:message</div>') }}
    </div>

    <div class="form-group {{{ $errors->has('description') ? 'error' : '' }}}">
        <label class="control-label" for="description">Description (facultatif)</label>
    </div>
    <textarea class="input-block-level" id="summernote-description" name="description" value="description" rows="18">{{{ Input::old('description', isset($slider) ? $slider->description : null) }}}
    </textarea>
    {{ $errors->first('description', '<div class="alert alert-danger">:message</div>') }}

    <div class="form-group {{{ $errors->has('href') ? 'error' : '' }}}">
        <label class="control-label" for="href">Liens global du slide</label>
        <input class="form-control" type="text" name="href" id="href" value="{{{ Input::old('href', isset($slider) ? $slider->href : null) }}}" />
        {{ $errors->first('href', '<div class="alert alert-danger">:message</div>') }}
        <p class="help-block">Veuillez saisir une adresse complète ! (ex : <strong>http://www.</strong>google.com)</p>
    </div>

    <div class="form-group {{{ $errors->has('order') ? 'error' : '' }}}">
        <label class="control-label" for="order">Ordre (max:{{( isset($slider) ? $slider->maxOrder() : $maxOrder )}})</label>
        <input class="form-control" type="text" name="order" id="order" value="{{{ Input::old('order', isset($slider) ? $slider->order : $maxOrder + 1) }}}" />
        {{ $errors->first('order', '<div class="alert alert-danger">:message</div>') }}
        <p class="help-block">Veuillez saisir un nombre pour classer vos slide de 0 à infinie... (ex : 0, 1, 2, 3, 4, 5,...)</p>
    </div>
</fieldset>