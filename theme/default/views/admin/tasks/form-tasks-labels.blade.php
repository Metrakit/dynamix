@foreach($labels as $label)
    <div>
    	<input type='checkbox' class='task-box' name='task_labels[]' value='{{$label->id}}' id='label_{{$label->id}}'  @if(in_array($label->id, $task_labels)) checked @endif>
    	<label for='label_{{$label->id}}'><i class='fa fa-check'> </i> <span  class='label-task-{{Str::slug($label->label)}}'>{{$label->label}}</span></label>
    </div>
@endforeach
