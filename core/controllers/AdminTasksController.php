<?php

class AdminTasksController extends BaseController {

	/**
	 * Generate list tasks
	 *
	 * @return Response
	 */
	public function generateShow() {
		
		$datas = array();
		if(Auth::check()){
			$datas['tasks'] = Task::all();
		}
		$datas['labels'] = TasksLabels::all();
		return $datas;
		/*if (Request::ajax()) {
			return Response::json(View::make( 'tasks.list', $datas )->renderSections());
		} else {
			return View::make( 'tasks.display', $datas );
		}*/
	}

	/**
	 * [addPostTask description]
	 */
	public function store(){
		if(Input::has('task_label')){ 
			$task = new Task;
			$task->label = Input::get('task_label');
			$task->save();
		}
		return Redirect::back();
	}

	/**
	 * renvoi les données ou affiche le formulaire d'edition d'une tache
	 * @param  Task   $task [description]
	 * @return [type]       [description]
	 */
	public function edit($task_id){
		$task = Task::find($task_id);
		$labels = TasksLabels::all();
		$idsLabel = array();
		foreach($task->labels as $label){
			$idsLabel[] = $label->id;
		}
		$users = AuthUser::all();
		$idsUser = array();
		foreach($task->auths as $user){
			$idsUser[] = $user->id;
		}
		return View::make('tasks.edit', array(
					'task' => $task,
					'user' => Auth::user(),
					'noAriane' => true,
					'labels' => $labels,
					'idsLabel' => $idsLabel,
					'users' => $users,
					'idsUser' => $idsUser,
			));
	}

	/**
	 * [editPostTask description]
	 * @return [type] [description]
	 */
	public function update($id){
		$task = Task::find($id);

		if($task){
			DB::beginTransaction();
			$task->label = Input::get('task_label');
			$task->description = Input::get('task_description');
			$task->date = new DateTime(Input::get('task_date'));
			if($task->save()){
				$labels = (Input::get('task_labels') !== null?Input::get('task_labels'): array());
				$users = (Input::get('task_users') !== null?Input::get('task_users'): array());
				//$users = Input::get('task_users');
				$task->labels()->sync($labels);
				$task->auths()->sync($users);
				DB::commit();
			}
		}
		return Redirect::back();
	}

	public function destroy($id_task){
		$task = Task::find($id_task);
		if($task){
			$task->delete();
		}
		return Redirect::route('index_admin');
	}

}