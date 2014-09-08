<div class="menu-object menu-object-{{$role}}">
	<div class="buttons">
		{{ Form::open(array('url' => 'admin/menu/' . $menu->id, 'class' => 'pull-right')) }}
			{{ Form::hidden('_method', 'DELETE') }}
			<button type="submit" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-remove"></span></button>
		{{ Form::close() }}
		<div class="pull-right"><a href="{{URL::to('admin/menu/' . $menu->id . '/edit')}}" class="btn btn-primary btn-xs pencil"><span class="glyphicon glyphicon-pencil"></span></a></div>
		<div class="clearfix"></div>
	</div>

	<div class="menu-object-{{$role}}-content">
		@if($menu->order != 1)
		<div class="move move-{{( $role == 'parent' ? 'left' : 'up' )}}">
			{{ Form::open(array('url' => 'admin/menu/' . $menu->id . '/move')) }}
				{{ Form::hidden('direction', ( $role == 'parent' ? 'left' : 'up' ) ) }}
				<button type="submit"><span class="glyphicon glyphicon-chevron-{{( $role == 'parent' ? 'left' : 'up' )}}"></span></button>
			{{ Form::close() }}
		</div>
		@endif

		<div class="content {{(!$menu->hasResource()?'text-danger':'')}}">
			{{$menu->title}} <small>({{$menu->resource_name()}})</small>
		</div>
		
		@if(!$menu->isMaxOrder())
		<div class="move move-{{( $role == 'parent' ? 'right' : 'down' )}}">
			{{ Form::open(array('url' => 'admin/menu/' . $menu->id . '/move')) }}
				{{ Form::hidden('direction', ( $role == 'parent' ? 'right' : 'down' ) ) }}
				<button type="submit"><span class="glyphicon glyphicon-chevron-{{( $role == 'parent' ? 'right' : 'down' )}}"></span></button>
			{{ Form::close() }}
		</div>
		@endif
		{{( $role == 'parent' ? '<div class="clearfix"></div>' : '' )}}
	</div>
</div>