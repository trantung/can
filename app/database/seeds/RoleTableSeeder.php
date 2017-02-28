<?php

class RoleTableSeeder extends Seeder {

	public function run()
	{
		Role::create([
			'name' => 'Admin',
			'description'=> 'Role is Admin',
		]);
		Role::create([
			'name' => 'Mod',
			'description'=> 'Role is Editor',
		]);
		Role::create([
			'name' => 'Member',
			'description'=> 'Role is Seo',
		]);
	}

}