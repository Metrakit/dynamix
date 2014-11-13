<!-- Dépendance:: $resource_not_allowed -->
<!-- tile = tuile -->
<!-- TO Maintain -->
<h2>{{{ Lang::get('admin.resource_not_allowed') }}}</h2>
<div class="col-sm-12">
	<?php $h3 = ''; ?>
	@foreach($resource_not_allowed as $resource)
	<div class="col-md-4">
	<h3>{{{ Lang::get('admin.rsc'.$h3 = ( $resource->getClassName() != $h3 ? $resource->getClassName() : $h3 )) }}}</h3>
	 	@include('admin.page.presenter', array('page'=>$resource))
	</div>
	@endforeach
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>