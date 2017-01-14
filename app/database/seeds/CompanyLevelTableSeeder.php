<?php

class CompanyLevelTableSeeder extends Seeder {

	public function run()
	{
		CompanyCategoryLevel::create([
			'name'=> 'Tập đoàn',
			'slug'=> 'tap-doan'
		]);
		CompanyCategoryLevel::create([
			'name'=> 'Công ty',
			'slug'=> 'cong-ty'
		]);
		CompanyCategoryLevel::create([
			'name'=> 'Chi nhánh',
			'slug'=> 'chi-nhanh',
		]);
		CompanyCategoryLevel::create([
			'name'=> 'Phòng ban',
			'slug'=> 'phong-ban',
		]);
        CompanyCategoryLevel::create([
            'name'=> 'Bộ phận',
            'slug'=> 'bo-phan',
        ]);
        CompanyCategoryLevel::create([
            'name'=> 'Đội nhóm',
            'slug'=> 'doi-nhom',
        ]);
	}

}