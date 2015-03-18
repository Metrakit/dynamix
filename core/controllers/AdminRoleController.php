<?php

class AdminRoleController extends BaseController {
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//User
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;
		$data['buttonLabel'] 	= Lang::get('button.add');
		$data['glyphicon'] 		= 'plus';
		
		return View::make('theme::' .'admin.role.create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), Config::get('validator.admin.role'));

		if ( $validator->passes() ) {
			$role = new Role();
            $role->name     		= Input::get('name');
            $role->deletable   		= 1;
           
            // Was the blog post created?
            if ( $role->save() ) {
                //Set all permission to deny
            	$resources = Resource::where('in_admin_ui','=',1)->get();
            	$data = array();
            	foreach($resources as $resource){
	                foreach(Action::all() as $action){
	                    $data[] = array(
	                        'role_id'       => $role->id,
	                        'type'          => 'deny',
	                        'action_id'     => $action->id,
	                        'resource_id'   => $resource->id
	                    );
	                }
	            }
				DB::table('permissions')->insert( $data );

				//track user
				parent::track('create','Role',$role->id);
                
                return Redirect::to('admin/role_permission')->with('success', Lang::get('admin.role_save_success'));
            }

            // Redirect to the blog post create role
            return Redirect::to('admin/role/create')->with('error', Lang::get('admin.role_save_fail'));
        }

        // Form validation failed
        return Redirect::to('admin/role/create')->withInput()->withErrors($validator);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//User
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;
		$data['buttonLabel'] 	= Lang::get('button.update');
		$data['glyphicon'] 		= 'ok';

	    $data['role'] = Role::find($id);
	    if(empty($data['role'])) return Redirect::back()->with('error', Lang::get('admin.role_empty') );

		return View::make('theme::' .'admin.role.edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Config::get('validator.admin.role'));

		if ( $validator->passes() ) {
			
			$role = Role::find($id);
            if ( !empty($role) ) {
	            $role->name     		= Input::get('name');
	           
	            // Was the blog post created?
	            if ( $role->save() ) {
	                // Redirect to the new blog post role
	                //track user
	                parent::track('update','Role',$role->id);
                
	                return Redirect::to('admin/role_permission')->with('success', Lang::get('admin.role_edit_success'));
	            }
            }

            // Redirect to the blog post create role
            return Redirect::to('admin/role/' . $id . '/edit')->with('error', Lang::get('admin.role_edit_fail'));
        }

        // Form validation failed
        return Redirect::to('admin/role/' . $id . '/edit')->withInput()->withErrors($validator);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy ($id) {
		//find resource
		$role = Role::find($id);

		//delete all permissions
		foreach ( $role->permissions as $permission ) {
			if (!$permission->delete()) return Redirect::to('admin/role_permission')->with('error', Lang::get('admin.role_delete_fail'));
		}

		// delete
		if ( $role->delete() ) {
			//track user
			parent::track('delete','Role', $role->id);
                
			return Redirect::to('admin/role_permission')->with('success', Lang::get('admin.role_delete_success'));;
		}
		
		return Redirect::to('admin/role_permission')->with('success', Lang::get('admin.role_delete_fail'));;
	}
}