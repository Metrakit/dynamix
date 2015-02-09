<div class="tasks">
	@if(sizeof($tasks) > 0)
		@foreach($tasks as $task)
			<div class="task-card">
				<a href="{{URL::Route('admin.task.edit', array($task->id))}}">
				@foreach($task->labels as $label)
					<span class="label-task-min label-task-{{Str::slug($label->label)}}" title="{{$label->label}}">{{$label->label}}</span>
				@endforeach
				<div class="clearfix"></div>
				<p>{{$task->label}}</p>
				@if($task->date != '0000-00-00 00:00:00')
					<span class="task-priority task-priority-{{$task->getPriority()}}">{{$task->getDate('%A %d %B %Y')}}</span>
				@endif
				</a>
			</div>
		@endforeach
	@else
		<p class="alert alert-info">Aucune taches n'est créer</p>
	@endif
</div>