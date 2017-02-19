<?php

class PermissionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [];
		return View::make('admin.permission.index')->with(compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createRole()
	{
		$modules = DB::table('modules')->lists('name','id');
		$permissions = DB::table('permissions')->get();
		foreach ($modules as $key => $value) {
			foreach ($permissions as $k => $val) {
				$listRole[$key][] = $val;
			}
		}
		return View::make('admin.permission.create-role')->with(compact('listRole'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createUser()
	{
		$modules = DB::table('modules')->lists('name','id');
		$permissions = DB::table('permissions')->get();
		$listRole = Role::lists('name','id');
		foreach ($modules as $key => $value) {
			foreach ($permissions as $k => $val) {
				$listPermission[$key][] = $val;
			}
		}
		$listUser = DB::table('admins')->get();
		return View::make('admin.permission.create-user')->with(compact('listPermission','listUser', 'listRole'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::except('_token');
		// dd($input['permission']);
		//saver role
		$roleId = Role::create(['name' =>$input['name']])->id;
		// dd($roleId);
		// save vao bang chung(module_role_permission)
		$arrayKey = array_keys($input['permission']);
		foreach ($arrayKey as $key => $value) {
			$v = explode('_', $value);
			$listUser = DB::table('module_role_permission')->insert([
				'module_id' => $v[0],
				'permission_id' => $v[1],
				'role_id' => $roleId,
			]);
		}
		dd(123);
	}

	public function updateRole($id)
	{
		$input = Input::except('_token');
		ModuleRolePermission::where('role_id', $id)->delete();
		//saver role
		Role::find($id)->update(['name' =>$input['name']]);
		// dd($roleId);
		// save vao bang chung(module_role_permission)
		$arrayKey = array_keys($input['permission']);
		foreach ($arrayKey as $key => $value) {
			$v = explode('_', $value);
			$listUser = DB::table('module_role_permission')->insert([
				'module_id' => $v[0],
				'permission_id' => $v[1],
				'role_id' => $id,
			]);
		}
		dd(44);
	}

	public function editRole($id)
	{
		$modules = DB::table('modules')->lists('name','id');
		$permissions = DB::table('permissions')->get();
		foreach ($modules as $key => $value) {
			foreach ($permissions as $k => $val) {
				$listRole[$key][] = $val;
			}
		}
		return View::make('admin.permission.edit-role')->with(compact('id', 'listRole'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeUser()
	{
		$input = Input::except('_token');
		foreach ($input['role'] as $value) {
			DB::table('role_users')->insert([
				'user_id' => $input['user_id'],
				'role_id' => $value,
			]);
		}
		//saver role
		$arrayKey = array_keys($input['permission']);

		foreach ($arrayKey as $key => $value) {
			$v = explode('_', $value);
			$listUser = DB::table('permission_users')->insert([
				'module_id' => $v[0],
				'permission_id' => $v[1],
				'user_id' => $input['user_id'],
			]);
		}
		dd(123);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function editUser($id)
	{
		$modules = DB::table('modules')->lists('name','id');
		$permissions = DB::table('permissions')->get();
		$listRole = Role::lists('name','id');
		foreach ($modules as $key => $value) {
			foreach ($permissions as $k => $val) {
				$listPermission[$key][] = $val;
			}
		}
		$listUser = DB::table('admins')->get();
		return View::make('admin.permission.edit-user')->with(compact('id', 'listPermission','listUser', 'listRole'));
	}

	public function updateUser($id)
	{
		$input = Input::except('_token');
		RoleUser::where('user_id', $id)->delete();
		PermissionUser::where('user_id', $id)->delete();
		foreach ($input['role'] as $key => $value) {
			DB::table('role_users')->insert([
				'user_id' => $input['user_id'],
				'role_id' => $key,
			]);
		}
		//saver role
		$arrayKey = array_keys($input['permission']);

		foreach ($arrayKey as $key => $value) {
			$v = explode('_', $value);
			$listUser = DB::table('permission_users')->insert([
				'module_id' => $v[0],
				'permission_id' => $v[1],
				'user_id' => $input['user_id'],
			]);
		}
		dd(44);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
