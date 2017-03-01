<?php

class PermissionController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Role::lists('name', 'id');
		return View::make('admin.permission.index')->with(compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createRole()
	{

		$modules = Module::lists('name','id');
		return View::make('admin.permission.create-role')->with(compact('modules'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createUser()
	{
		$modules = Module::lists('name','id');
		$listRole = Role::lists('name','id');
		$listUser = Admin::all();
		return View::make('admin.permission.create-user')->with(compact('listUser', 'listRole', 'modules'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::except('_token');
		$roleId = Role::create(['name' =>$input['name']])->id;
		if (isset($input['permission'])) {
			$inputPrimaryKey = ['role_id' => $roleId];
			$inputSave = ['permission_id' => array_keys($input['permission'])];
			Common::saveOneToMany('RolePermission', $inputPrimaryKey, $inputSave);
			return Redirect::action('PermissionController@index');
		}
		dd('chua nhap quyen');
		// return Redirect::action('PermissionController@error');
	}

	public function updateRole($id)
	{
		$input = Input::except('_token');
		RolePermission::where('role_id', $id)->delete();
		//saver role
		Role::find($id)->update(['name' =>$input['name']]);
		// save vao bang chung(module_role_permission)
		if (isset($input['permission'])) {
			$inputPrimaryKey = ['role_id' => $id];
			$inputSave = ['permission_id' => array_keys($input['permission'])];
			Common::saveOneToMany('RolePermission', $inputPrimaryKey, $inputSave);
			return Redirect::action('PermissionController@index');
		}
		return Redirect::action('PermissionController@index');
	}

	public function editRole($id)
	{
		$modules = Module::lists('name','id');
		$role = Role::find($id);
		return View::make('admin.permission.edit-role')->with(compact('modules', 'role'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeUser()
	{
		$input = Input::except('_token');
		if (isset($input['role_id'])) {
			$inputPrimaryKey = ['user_id' => $input['user_id']];
			$inputSave = ['role_id' => array_keys($input['role_id'])];
			Common::saveOneToMany('RoleUser', $inputPrimaryKey, $inputSave);
			//to do??
		}
		if (isset($input['permission'])) {
			$inputPrimaryKey = ['user_id' => $input['user_id']];
			$inputSave = ['permission_id' => array_keys($input['permission'])];
			Common::saveOneToMany('PermissionUser', $inputPrimaryKey, $inputSave);
			//to do?? 
		}
		return Redirect::action('PermissionController@index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function editUser($id)
	{
		$modules = Module::lists('name','id');
		$user = Admin::find($id);
		$listRole = Role::lists('name','id');
		return View::make('admin.permission.edit-user')->with(compact('user', 'modules', 'listRole'));
	}

	public function updateUser($id)
	{
		$input = Input::except('_token');
		RoleUser::where('user_id', $id)->delete();
		PermissionUser::where('user_id', $id)->delete();

		if (isset($input['role_id'])) {
			$inputPrimaryKey = ['user_id' => $id];
			$inputSave = ['role_id' => array_keys($input['role_id'])];
			Common::saveOneToMany('RoleUser', $inputPrimaryKey, $inputSave);
		}
		if (isset($input['permission'])) {
			$inputPrimaryKey = ['user_id' => $id];
			$inputSave = ['permission_id' => array_keys($input['permission'])];
			Common::saveOneToMany('PermissionUser', $inputPrimaryKey, $inputSave);
		}
		
		dd(44);
		return Redirect::action('PermissionController@index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		RolePermission::where('role_id', $id)->delete();
		Role::find($id)->delete();
		return Redirect::action('PermissionController@index');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexUser()
	{
		$data = Admin::lists('username', 'id');
		return View::make('admin.permission.index-user')->with(compact('data'));
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyUser($id)
	{
		RoleUser::where('user_id', $id)->delete();
		PermissionUser::where('user_id', $id)->delete();
		return Redirect::action('PermissionController@index');
	}


}
