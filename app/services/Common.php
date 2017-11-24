<?php
class Common {

	public static function hasRole($roleID){
		if( !Auth::admin()->check() ){
			return false;
		}
		$userid = Auth::admin()->get()->id;
		$listRole = RoleUser::where('user_id', $userid)->lists('role_id');
		
		if( in_array($roleID, $listRole) | in_array(ADMIN, $listRole) ){
			return true;
		}
		return false;
	}

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
					return 'N/A';
				}
			} else {
				$adminId = $scale->user_id;
			}
			$admin = Admin::find($adminId);
			if ($admin) {
				return $admin->username;
			}
			
		}
		return 'N/A';
	}
	public static function listNameProductAndCategory()
	{
		$listProduct = Product::all();
		$listProductCategory = ProductCategory::all();
		$array = [];
		foreach ($listProduct as $key => $value) {
			$modelId = PRODUCT.$value->id;
			$array[$modelId] = $value->name;
		}
		foreach ($listProductCategory as $k => $v) {
			$modelCategoryId = PRODUCTCATEGORY.$v->id;
			$array[$modelCategoryId] = $v->name;
		}
		return $array;
	}
}