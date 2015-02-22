<!-- Dépendance:: $resource_not_allowed -->
<!-- tile = tuile -->
<!-- TO Maintain -->
@if (count($resource_not_allowed) > 0)
<h2>{{{ Lang::get('admin.resource_not_allowed') }}}</h2>
<div class="col-sm-12">
	@foreach($resource_not_allowed as $resourcesK => $resourcesV)
	@if (count($resourcesV)>0)
	<h3>{{{ Lang::get($resourcesK::$rscName) }}}</h3>
	@foreach( $resourcesV as $r)
	 	@include($resourcesK::$presenter , array(strtolower($resourcesK)=>$r))
	@endforeach
	<div class="clearfix"></div>
	@endif
	@endforeach
</div>
<div class="clearfix"></div>
@endif