<?php

class PermissionTableSeeder extends Seeder {

	public function run()
	{
		//quyền cho chức năng phân quyền
		Permission::create([
			'module_id' => 1,
			'name'=> 'Phân quyền nhân viên',
		]);

		//quyền cho crud nhân viên module_id =2
		Permission::create([
			'module_id' => 2,
			'name'=> 'Tạo mới nhân viên',
		]);
		Permission::create([
			'module_id' => 2,
			'name'=> 'Sửa nhân viên',
		]);
		Permission::create([
			'module_id' => 2,
			'name'=> 'Xem nhân viên',
		]);
		Permission::create([
			'module_id' => 2,
			'name'=> 'Xoá nhân viên',
		]);

		//quyền cho crud công ty module_id =3
		Permission::create([
			'module_id' => 3,
			'name'=> 'Tạo mới công ty/chi nhánh/phòng ban',
		]);
		Permission::create([
			'module_id' => 3,
			'name'=> 'Sửa công ty/chi nhánh/phòng ban',
		]);
		Permission::create([
			'module_id' => 3,
			'name'=> 'Xem công ty',
		]);
		Permission::create([
			'module_id' => 3,
			'name'=> 'Xoá công ty/chi nhánh/phòng ban',
		]);
		
		// quyền cho chức năng tìm kiếm module_id =4
		Permission::create([
			'module_id' => 4,
			'name'=> 'Cho phép tìm kiếm',
		]);
		
		// quyền cho chức năng lịch sử công tác module_id = 5
		Permission::create([
			'module_id' => 5,
			'name'=> 'Xem lịch sử công tác',
		]);

		//quyền cho chức năng nhập bảo hiểm module_id = 6
		Permission::create([
			'module_id' => 6,
			'name'=> 'Tạo mới bảo hiểm',
		]);
		Permission::create([
			'module_id' => 6,
			'name'=> 'Sửa bảo hiểm',
		]);
		Permission::create([
			'module_id' => 6,
			'name'=> 'Xem danh sách bảo hiểm',
		]);
		Permission::create([
			'module_id' => 6,
			'name'=> 'Xoá bảo hiểm',
		]);

		//quyền cho chức năng nhập lương module_id = 7
		Permission::create([
			'module_id' => 7,
			'name'=> 'nhập lương thủ công',
		]);
		Permission::create([
			'module_id' => 7,
			'name'=> 'Nhập lương import',
		]);
		Permission::create([
			'module_id' => 7,
			'name'=> 'Sửa tiền lương',
		]);
		Permission::create([
			'module_id' => 7,
			'name'=> 'Xem list lương',
		]);
		Permission::create([
			'module_id' => 7,
			'name'=> 'Xoá lương',
		]);

	}

}