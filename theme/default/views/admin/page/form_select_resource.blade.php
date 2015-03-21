<select name="blockable_data" id="blockable_data" class="form-control">
	@foreach( BlockType::orderBy('multi', 'ASC')->get() as $block_type)
		<?php
		$blockModelName=$block_type->model
		?>
		@if ($block_type->multi == 0)
			<option value="{{$block_type->id}}|{{($block_type->linked_on_module==1?'1':'new')}}|{{$blockModelName::$blockable_type}}">{{{Lang::get($block_type->lang)}}}</option>
		@else
			@if(method_exists($blockModelName, 'getFreeObjects'))
				@if(count($blockModelName::getFreeObjects()) > 0)
				<optgroup label="{{{ ucfirst($block_type->name) }}}">
					@foreach($blockModelName::getFreeObjects() as $object)
					<option value="{{$block_type->id}}|{{$object->id}}|{{get_class($object)}}" >{{$object->title()}}</option>
					@endforeach
				</optgroup>
				@endif
			@else
				<option>{{$blockModelName}} Model has not getFreeObjects method</option>
			@endif
		@endif
	@endforeach
</select>