<?php
class Common {

	public static function getPermissionByModule($moduleId)
	{
		return Permission::where('module_id', $moduleId)->lists('name', 'id');
	}

	public static function saveOneToMany($modelName, $inputPrimaryKey, $input)
	{
		if ($input) {
			foreach ($input as $key => $value) {
				foreach ($value as $v) {
					$saveRole = $modelName::create([
						$key => $v,
						array_keys($inputPrimaryKey)[0] => array_values($inputPrimaryKey)[0],
					])->id;
					if (!$saveRole) {
						dd(INSERT_HAS_FAIL);
					}
				}
				
			}
		}
		return true;
	}

	public static function getCompany()
	{
		$list = Company::where('level', 3)->lists('name', 'id');
		return $list;
	}
	public static function getDepartmentByCompany($companyId)
	{
		$list = Company::where('level', 4)
			->where('parent_id', $companyId)
			->lists('name', 'id');
		return $list;
	}
	public static function getNameByStorageLoss($modelName, $modelId)
	{
		$ob = $modelName::find($modelId);
		if ($ob) {
			return $ob->name;
		}
		return null;
	}
	public static function getCustomerGroup()
	{
		$group = CustomerGroup::lists('name', 'id');
		return $group;
	}
	public static function getCustomerList()
	{
		$customerList = CustomerShip::lists('customer_name', 'id');
		return $customerList;
	}
	public static function getKieuCan()
	{
		$array = [ '' => 'Chọn tất cả',
			1 => 'Xuất kho',
			2 => 'Nhập kho', 
			3 => 'Chuyển xuất',
			4 => 'Chuyển nhập',
			5 => 'Chuyển tiếp kho nội bộ',
			6 => 'Chuyển tiếp kho ngoài',
			7 => 'Cân hộ',
		];
		return $array;
	}
	public static function getNameKieuCan($type)
	{
		$array = self::getKieuCan();
		if ($array[$type]) {
			return $array[$type];
		}
		return null;
	}
	public static function getNhanviencanKcs($scaleRateId, $kcs = null)
	{
		$scale =ScaleKCS::find($scaleRateId);
		if ($scale) {
			if ($kcs) {
				$kcsDetail = ScaleKCS::where('type', 'KCS')
					->where('number_ticket', $scale->number_ticket)
					->orderBy('id', 'desc')
					->first();
				if ($kcsDetail) {
					$adminId = $kcsDetail->user_id;
				} else {
					return 'không xác định nhân viên KCS';
				}
			} else {
				$adminId = $scale->user_id;
			}
			$admin = Admin::find($adminId);
			if ($admin) {
				return $admin->username;
			}
			
		}
		return 'không xác định được nhân viên cân';
		
	}
}