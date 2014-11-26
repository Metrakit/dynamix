<fieldset>

    <!-- page_title -->
    <?php
        $data_i18n = array();
        $data_i18n['field_name'] = 'page_title';
        $data_i18n['lang_name'] = 'page_title';
        if(isset($tag)){
            $data_i18n['object'] = $tag;
            $data_i18n['method_locale'] = $data_i18n['field_name'].'_locale';
        } 
    ?>
    @include('admin.i18n.input_text_4form', $data_i18n)
    <!-- ./ page_title -->

    <!-- page_title -->
    <?php
        $data_i18n = array();
        $data_i18n['field_name'] = 'page_meta_description';
        $data_i18n['lang_name'] = 'page_meta_description';
        if(isset($tag)){
            $data_i18n['object'] = $tag;
            $data_i18n['method_locale'] = $data_i18n['field_name'].'_locale';
        } 
    ?>
    @include('admin.i18n.textarea_4form', $data_i18n)
    <!-- ./ page_title -->

    @if(isset($page))
    @if($page->url != '/')
        <!-- page_title -->
        <?php
            $data_i18n = array();
            $data_i18n['field_name'] = 'page_url';
            $data_i18n['lang_name'] = 'page_url';
            if(isset($tag)){
                $data_i18n['object'] = $tag;
                $data_i18n['method_locale'] = $data_i18n['field_name'].'_locale';
            } 
        ?>
        @include('admin.i18n.input_url_4form', $data_i18n)
        <!-- ./ page_title -->
    @endif
    @else
        <!-- page_title -->
        <?php
            $data_i18n = array();
            $data_i18n['field_name'] = 'page_url';
            $data_i18n['lang_name'] = 'page_url';
            if(isset($tag)){
                $data_i18n['object'] = $tag;
                $data_i18n['method_locale'] = $data_i18n['field_name'].'_locale';
            } 
        ?>
        @include('admin.i18n.input_url_4form', $data_i18n)
        <!-- ./ page_title -->
    @endif

   <!--  <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
       <label class="col-md-2 control-label" for="content">Contenu de la page *</label>
       <div class="col-md-8">
           <textarea class="input-block-level" id="content" name="content" value="content" rows="18">{{{ Input::old('content', isset($page) ? $page->content : null) }}}
           </textarea>
       </div>
   </div> -->

</fieldset>