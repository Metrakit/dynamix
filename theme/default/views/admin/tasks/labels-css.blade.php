@section('css')
<style>
	@foreach($labels as $label)
		.label-task-{{Str::slug($label->label)}} {
			background: {{$label->color}};
		}
	@endforeach
</style>
@stop