@foreach($users as $user)
    <div>
    	<input type='checkbox' class='task-box' name='task_users[]' value='{{$user->id}}' id='user_{{$user->id}}' @if(in_array($user->id, $task_users)) checked @endif>
    	<label for='user_{{$user->id}}'><i class='fa fa-check'> </i> <span >{{$user->email}}</span></label>
    </div>
@endforeach
