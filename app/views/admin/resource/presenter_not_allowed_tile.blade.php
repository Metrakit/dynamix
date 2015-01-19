<!-- Dépendance:: $resource_not_allowed -->
<!-- tile = tuile -->
<!-- TO Maintain -->
@if (count($resource_not_allowed) > 0)
<h2>{{{ Lang::get('admin.resource_not_allowed') }}}</h2>
<div class="col-sm-12">
	@foreach($resource_not_allowed as $resourcesK => $resourcesV)
	@if (count($resourcesV)>0)
	<h3>{{{ Lang::get('admin.rsc'.$resourcesK) }}}</h3>
	@foreach( $resourcesV as $r)
	<div class="col-md-4">
	 	@include('admin.'. strtolower($resourcesK) .'.presenter', array(strtolower($resourcesK)=>$r))
	</div>
	@endforeach
	<div class="clearfix"></div>
	@endif
	@endforeach
</div>
<div class="clearfix"></div>
@endif