<?php

class ModuleTableSeeder extends Seeder {

	public function run()
	{
		Module::create([
			'name'=> 'Phân quyền',
		]);
		Module::create([
			'name'=> 'Nhân sự',
		]);
		Module::create([
			'name'=> 'Công ty',
		]);
		Module::create([
			'name'=> 'Tìm kiếm',
		]);
		Module::create([
			'name'=> 'Lịch sử công tác',
		]);
		Module::create([
			'name'=> 'Nhập bảo hiểm',
		]);
		Module::create([
			'name'=> 'Nhập lương',
		]);

	}

}