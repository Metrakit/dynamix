<div class="menu-object menu-object-{{$role}}">

<div class="width100">

	@if($nav->order != 1)
	<div class="move move-{{( $role == 'parent' ? 'left' : 'up' )}}">
		{{ Form::open(array('url' => 'admin/navigation/' . $nav->id . '/move')) }}
			{{ Form::hidden('direction', ( $role == 'parent' ? 'left' : 'up' ) ) }}
			<button type="submit"><span class="glyphicon glyphicon-chevron-{{( $role == 'parent' ? 'left' : 'up' )}}"></span></button>
		{{ Form::close() }}
	</div>
	@endif

	<div class="menu-container">
		<div class="buttons">
			{{ Form::open(array('url' => 'admin/navigation/' . $nav->id, 'class' => 'pull-right')) }}
				{{ Form::hidden('_method', 'DELETE') }}
				<button type="submit" class="btn btn-transparent btn-xs remove"><span class="glyphicon glyphicon-remove"></span></button>
			{{ Form::close() }}
			<div class="pull-right"><a href="{{URL::to('admin/navigation/' . $nav->id . '/edit')}}" class="btn btn-transparent btn-xs pencil"><span class="glyphicon glyphicon-pencil"></span></a></div>
			<div class="clearfix"></div>
		</div>

		<div class="menu-object-{{$role}}-content">

			<div class="content {{(!$nav->hasResource() ?'text-danger':'')}}">
				{{$nav->title()}}
			</div>
			
		</div>
	</div>
	
	@if(!$nav->isMaxOrder())
	<div class="move move-{{( $role == 'parent' ? 'right' : 'down' )}}">
		{{ Form::open(array('url' => 'admin/navigation/' . $nav->id . '/move')) }}
			{{ Form::hidden('direction', ( $role == 'parent' ? 'right' : 'down' ) ) }}
			<button type="submit"><span class="glyphicon glyphicon-chevron-{{( $role == 'parent' ? 'right' : 'down' )}}"></span></button>
		{{ Form::close() }}
	</div>
	@endif
	{{( $role == 'parent' ? '<div class="clearfix"></div>' : '' )}}

</div>

</div>