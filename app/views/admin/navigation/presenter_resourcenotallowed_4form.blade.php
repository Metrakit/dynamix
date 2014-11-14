<!-- Dépendance:: $resource_not_allowed -->
<!-- tile = tuile -->
<!-- TO Maintain -->
@foreach($resource_not_allowed as $resourcesK => $resourcesV)
<optgroup label="{{{ Lang::get('admin.rsc'.$resourcesK) }}}">
@foreach( $resourcesV as $r)
 	@include('admin.page.presenter', array('page'=>$r))
	<option value="Page|{{$r->id}}">{{$r->title()}}</option>
@endforeach
</optgroup>
@endforeach