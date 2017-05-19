<?php
use Carbon\Carbon;
class CommonNormal
{
	public static function delete($id)
	{
		$name = self::commonName();
		$name::find($id)->delete();
	}

	public static function update($id, $input, $modelName = NULL)
	{
		$name = self::commonName();
		if($modelName) {
			$name = $modelName;
		}
		$name::find($id)->update($input);
	}

	public static function create($input, $name = NULL)
	{
		$name = self::commonName($name);
		$id = $name::create($input)->id;
		return $id;
	}

	public static function commonName($name = NULL)
	{
		if ($name == NULL) {
			$name = Request::segment(2);
		}
		if ($name == '') {
			return 'AdminNew';
		}
		if($name =='news'){
			return 'AdminNew';
		}
		if($name =='newstype'){
			return 'TypeNew';
		}
		if ($name == 'manager') {
			return 'Admin';
		}
		if ($name == 'introduce') {
			return 'Introduce';
		}
		if ($name == 'bottomtext') {
			return 'BottomText';
		}
		if ($name == 'contact') {
			return 'Contact';
		}
		if ($name == 'slider') {
			return 'AdminSlide';
		}
		if ($name == 'type_about_us') {
			return 'TypeAboutUs';
		}
		if ($name == 'about_us_company') {
			return 'AboutUs';
		}

	}

	public static function storeDataScale($input)
	{
		$data = $this->getDataScale($input);
		$data['is_online'] = ONLINE;
		$id = ScaleKCS::create($data)->id;
		return $id;
	}

	public static function storeDataKCS($input)
	{
		$data = $this->getDataKCS($input);
		$data['is_online'] = ONLINE;
		$id = ScaleKCS::create($data)->id;
		return $id;
	}

	public function getDataScale($input)
	{
		$arrayKey = [
			'id_user' => 'user_id',
			'so_phieu' => 'number_ticket',
			'so_xe' => 'number_car',
			'id_the_loai' => 'category_id',
			'id_kieu_can' => 'transfer_type',
			'id_kho' => 'warehouse_id',
			'id_chi_nhanh_xuat_nhap' => 'department_id',
			'chien_dich_id' => 'campaign_code',
			'chien_dich_ten' => 'campaign_name',
			'chien_dich_phuong_tien' => 'campaign_method',
			'id_kh' => 'customer_id',
			'khach_hang_ten' => 'customer_name',
			'khach_hang_sdt' => 'customer_phone',
			'khach_hang_dia_chi' => 'customer_address',
			'khach_hang_fax' => 'customer_fax',
			'ngay_can' => 'scale_at',
			'gio_can_lan_1' => 'first_scale_hour',
			'gio_can_lan_2' => 'second_scale_hour',
			'kl_can_lan_1' => 'first_scale_weight',
			'kl_can_lan_2' => 'second_scale_weight',
			'kl_hang' => 'package_weight',
			'app_id' => 'app_id',
			'code' => 'code'
		];
		return $this->prepareData($input, $arrayKey);
	}

	public function getDataKCS($input)
	{
		$arrayKey = [
			'user_id' => 'user_id',
			'soPhieu' => 'number_ticket',
			'tongTL' => 'weight_total',
			'tlMun' => 'trong_luong_mun',
			'tlQuaCo' => 'trong_luong_qua_co',
			'tlVo' => 'trong_luong_vo',
			'tlTapChat' => 'trong_luong_tap_chat',
			'tyLeMun' => 'ty_le_mun',
			'tyLeQuaCo' => 'ty_le_qua_co',
			'tyLeTapChat' => 'ty_le_tap_chat',
			'tyLeVo' => 'ty_le_vo',
			'doKho' => 'do_kho',
			'thoiGian' => 'created_at',
			'app_id' => 'app_id',
			'code' => 'code',
			'type' => 'type'
		];
		return $this->prepareData($input, $arrayKey);
	}

	public function prepareData($input, $arrayKey)
	{
		$data = [];
		foreach ($input as $key => $value) {
			if ($arrayKey[$key]) {
				$data[$arrayKey[$key]] = $value;
			}
		}
		return $data;
	}

	public static function getProductCategoryId($stringIdCategory)
	{
		$model = [];
		$model[1] = $stringIdCategory[0];
		$model[0] = substr($stringIdCategory, 1);
		return $model;
	}

	public static function getOverloadRatio($stringIdCategory)
	{
		$model = $this->getProductCategoryId($stringIdCategory);
		$modelId = $model[0];
		$type = $model[1];
		if ($type == 1) {
			$modelName = 'Product';
		}
		if ($type == 2) {
			$modelName = 'ProductCategory';
		}
		$data = OverloadRatio::where('model_name', $modelName)
			->where('model_id', $modelId)
			->orderBy('id', 'DESC')
			->first();
		return json_decode($data->data);
	}

	public static function calcLuongTru($objScale, $objKcs)
	{
		$overloadRatio = $this->getOverloadRatio($objScale->category_id);
		foreach ($overloadRatio as $key => $value) {
			if(isset($objKcs->$key)){
				if ($objKcs->key > $value) {
					$luongtru[$key] = ($objKcs->key - $value) * ($objScale->package_weight)/100;
				}
			}
		}
		$total = 0;
		foreach ($luongtru as $k => $v) {
			$total = $total + $v;
		}
		return $total;
	}
	public static function saveStore($input)
	{
		$modelName = self::getProductCategoryId($input['id_the_loai']);
		if ($modelName[1] == 1) {
			$modelName = 'Product';
		}
		if ($modelName[1] == 2) {
			$modelName = 'ProductCategory';
		}
		$modelId = $model[0];
		$warehouseId = $input['id_kho'];
		
		$cal = StorageLoss::where('model_id', $modelId)
			->where('model_name', $modelName)
			->where('warehouse_id', $warehouseId)
			->first();

		//neu kho da co sp thi tinh toan cong(tru) va neu kho chua co sp day thi tao moi
		if ($cal) {
			//id_kieu_can : 1,2,3,4 tuc la xuat kho, nhap kho, chueyn xuat kho, chuyen nhap kho
			if ($input['id_kieu_can'] == 1) {
				$weight = $input['kl_hang'] + $cal->weight;
				$cal->update(['weight' => $weight]);
			}
			if ($input['id_kieu_can'] == 2) {
				$weight = $input['kl_hang'] - $cal->weight;
				$cal->update(['weight' => $weight]);
			}
			if ($input['id_kieu_can'] == 3) {
				$weight = $input['kl_hang'] + $cal->weight;
				$cal->update(['weight' => $weight]);
			}
			if ($input['id_kieu_can'] == 4) {
				$weight = $input['kl_hang'] - $cal->weight;
				$cal->update(['weight' => $weight]);
			}
			return true;

		} else {
			$weight = $input['kl_hang'];
			$id = StorageLoss::create(['model_id' => $modelId,
				'model_name' => $modelName,
				'warehouse_id' => $warehouseId,
				'weight' => $weight,
			])->id;
			return true;
		}
	}
}