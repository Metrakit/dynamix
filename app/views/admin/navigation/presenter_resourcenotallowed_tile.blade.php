<!-- Dépendance:: $resource_not_allowed -->
<!-- tile = tuile -->
<!-- TO Maintain -->
<h2>{{{ Lang::get('admin.resource_not_allowed') }}}</h2>
<div class="col-sm-12">
	@foreach($resource_not_allowed as $resourcesK => $resourcesV)
	<h3>{{{ Lang::get('admin.rsc'.$resourcesK) }}}</h3>
	@foreach( $resourcesV as $r)
	<div class="col-md-4">
	 	@include('admin.page.presenter', array('page'=>$r))
	</div>
	@endforeach
	<div class="clearfix"></div>
	@endforeach
</div>
<div class="clearfix"></div>