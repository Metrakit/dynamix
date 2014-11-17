<!-- Dépendance:: $resource_not_allowed -->
<!-- tile = tuile -->
<!-- TO Maintain -->
{{var_dump($selected)}}
@foreach($resource_not_allowed as $resourcesK => $resourcesV)
@if (count($resourcesV)>0)
<optgroup label="{{{ Lang::get('admin.rsc'.$resourcesK) }}}">
@if( $selected['current_resource_id'] != null && $selected['current_resource_type'] != null && $selected['current_resource_type'] == $resourcesK)
	<option value="{{$selected['current_resource_type']}}|{{$selected['current_resource_id']}}" selected>{{$selected['current_resource_type']::find($selected['current_resource_id'])->title()}}</option>
@endif
@foreach( $resourcesV as $r)
	<option value="Page|{{$r->id}}">{{$r->title()}}</option>
@endforeach
</optgroup>
@endif
@endforeach