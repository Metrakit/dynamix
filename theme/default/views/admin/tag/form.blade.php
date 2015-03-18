<!-- tag_name -->
<?php
    $data_i18n = array();
    $data_i18n['field_name'] = 'tag_name';
    $data_i18n['lang_name'] = 'tag_name';
    if(isset($tag)){
        $data_i18n['object'] = $tag;
        $data_i18n['method_locale'] = $data_i18n['field_name'].'_locale';
    } 
?>
@include('theme::admin.i18n.input_text_4form', $data_i18n)
<!-- ./ tag_name -->
<div class="form-group">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>