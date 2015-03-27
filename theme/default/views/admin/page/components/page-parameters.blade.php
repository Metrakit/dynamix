<p class="text-right page-properties">
	<span data-toggle="collapse" data-target="#page-parameters" aria-expanded="true"><i class="fa fa-fw fa-caret-down"></i> {{{ Lang::get('admin.page_parameters') }}}</span>
</p>


<hr class="page-properties-hr">
<div id="page-parameters" class="collapse">
	<!-- is commentable -->
	<div class="form-group {{{ $errors->has('is_commentable') ? 'has-error' : '' }}}">
        <label class="col-md-2 control-label" for="is_commentable">Activer les commentaires</label>
		<div class="col-md-10 col-lg-8 switch-container">
		    <div class="switch switch-inline">
		        <div class="switch-button">
		            <input id="is_commentable" name="is_commentable" class="cmn-toggle cmn-toggle-round-flat" type="checkbox" {{($page->is_commentable==1?'checked="checked"':'')}}>
		            <label for="is_commentable" class="label-list"></label>
		        </div>
		        <div class="clearfix"></div>
		    </div>
		</div>
	</div>
	<!-- ./ is commentable -->

	<!-- url -->
	<div class="form-group {{{ $errors->has('is_published') ? 'has-error' : '' }}}">
        <label class="col-md-2 control-label" for="is_published">Publier la page</label>
		<div class="col-md-10 col-lg-8 switch-container">
		    <div class="switch switch-inline">
		        <div class="switch-button">
		            <input id="is_published" name="is_published" class="cmn-toggle cmn-toggle-round-flat" type="checkbox" {{($page->is_published==1?'checked="checked"':'')}}>
		            <label for="is_published" class="label-list"></label>
		        </div>
		        <div class="clearfix"></div>
		    </div>
		</div>
	</div>
	<!-- ./ url -->
</div>
<hr class="page-properties-hr">