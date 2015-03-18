@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.dashboard') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.dashboard') }}}</h1>
    </div>
@stop
@include('theme::admin.tasks.labels-css', array('labels'=>$labels))
@section('content')
    @include('theme::admin.session.session-message')
    <div class="row head-task">
      <div class="col-md-2"><h3>Tâche</h3></div> 
      <div class="col-md-2">
        {{ Form::open(array('route' => array('admin.task.destroy', $task->id),'method' => 'DELETE')) }}
          <button type="submit" class="btn btn-danger">
            <i class="fa fa-times"></i>
            supprimer
          </button>
        {{ Form::close() }}
      </div> 
    </div>
    <div class="col-lg-8">
        {{ Form::open(array('route' => array('admin.task.update', $task->id),'method' => 'PUT')) }}
          
            <div class="input-group">
              <label>Label de la tâche</label>
              <input type="text" class="form-control" placeholder="label" name="task_label" value="{{ (Input::old('task_label')) ? Input::old('task_label') : $task->label }}">
            </div>
            <div class="input-group">
              <label>Description</label>
              <textarea class="form-control" placeholder="description" name="task_description">{{ (Input::old('task_description')) ? Input::old('task_description') : $task->description }}</textarea>
            </div> 
            <div class="input-group">
              <label>Date</label>
              <input class="form-control" name="task_date" value="{{ (Input::old('task_date')) ? Input::old('task_date') : $task->date }}">
            </div> 
            {{-- List of Label--}}
           <div>
              <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#lLabels" aria-expanded="false" aria-controls="lLabels">
                <i class="fa fa-bookmark"></i>
                Labels
                <i class="caret"></i>
              </button>
              <div class="collapse collapse-relative" id="lLabels">
                <div class="well">
                  @include('theme::admin.tasks.form-tasks-labels', array('labels' => $labels, 'task_labels' => $idsLabel))
                </div>
              </div>
            
            

            
            {{-- List of User --}}
                         

              <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#lUsers" aria-expanded="false" aria-controls="lUsers">
                <i class="fa fa-group"></i>
                Utilisateurs
                <i class="caret"></i>
              </button>
              <div class="collapse collapse-relative" id="lUsers">
                <div class="well">
                  @include('theme::admin.tasks.form-tasks-users', array('users' => $users, 'task_users' => $idsUser))
                </div>
              </div>
            </div>
            <div class="input-group">
              <button type="submit" class="btn btn-success"><div class="fa fa-check"></i> Modifier</button>
            </div>
        {{ Form::close() }}
       
    </div>
    
@stop

