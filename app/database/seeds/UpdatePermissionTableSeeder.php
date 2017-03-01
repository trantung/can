<?php

class UpdatePermissionTableSeeder extends Seeder {

	public function run()
	{
		$array = [
			'PermissionController',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',
			'PermissionController@createRole',

		];






		Role::update([
			'controller_action' => 'PermissionController@createRole',
			'description'=> 'Role is Admin',
		]);
	}

}