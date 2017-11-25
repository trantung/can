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
		$data = self::getDataScale($input);
		$data['is_online'] = ONLINE;
		$scaleStation = ScaleStation::where('app_id', $input['app_id'])
			->first();
		if (!$scaleStation) {
			$kcs = KcsLogInstall::where('app_id', $input['app_id'])
				->first();
			if (!$kcs) {
				dd('sai mã app vì mã app_id không có config với chi nhánh trạm cân nào');
			}
		}
		else {
			$data['department_id'] = $scaleStation->department_id;
		}
		$id = ScaleKCS::create($data)->id;
		//update ma chien dich vao bang scale_stations
		$obj = ScaleStation::where('app_id', $input['app_id'])
			->where('code', $input['code'])
			->update(['max_coupon' => $input['so_phieu'], 'max_campaign_code' => $input['chien_dich_id']]);
		return $id;
	}

	public static function storeDataKCS($input)
	{
		$data = self::getDataKCS($input);
		$scaleStation = ScaleStation::where('app_id', $input['app_id'])
			->first();
		if (!$scaleStation) {
			$kcs = KcsLogInstall::where('app_id', $input['app_id'])
				->first();
			if (!$kcs) {
				dd('sai mã app vì mã app_id không có config với chi nhánh trạm cân nào');
			}
		} else {
			$data['department_id'] = $scaleStation->department_id;
		}
		$data['is_online'] = ONLINE;
		$id = ScaleKCS::create($data)->id;
		return $id;
	}

	public static function getDataScale($input)
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
			'code' => 'code',
			'number_ticket_manual' => 'number_ticket_manual',
			'partner_code' => 'partner_code',
			'doi_tac_ten' => 'doi_tac_ten',
			'doi_tac_sdt' => 'doi_tac_sdt',
			'doi_tac_dia_chi' => 'doi_tac_dia_chi',
			'doi_tac_fax' => 'doi_tac_fax',
			'partner_id' => 'partner_id',
		];
		return self::prepareData($input, $arrayKey);
	}

	public static function getDataKCS($input)
	{
		$arrayKey = [
			'id_user' => 'user_id',
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
			'app_id' => 'app_id',
			'code' => 'code',
			'type' => 'type',
			'thoiGian' => 'time_kcs',
		];
		return self::prepareData($input, $arrayKey);
	}

	public static function prepareData($input, $arrayKey)
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
		$model = self::getProductCategoryId($stringIdCategory);
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
		return $data->data;
	}

	public static function calcLuongTru($objScale, $objKcs)
	{
		// dd($objScale->category_id);
		// $arr = self::getProductCategoryId($objScale->category_id);
		// $categoryId = $arr[0];
		$overloadRatio = self::getOverloadRatio($objScale->category_id);
		$luongtru = [];
		// dd($objKcs->ty_le_mun);
		foreach ($overloadRatio as $key => $value) {
			// dd($objKcs->$key);
			if(isset($objKcs->$key)){
				if ($objKcs->$key > $value) {

					$luongtru[$key] = ($objKcs->$key - $value) * ($objScale->package_weight)/100;
				}
			}
		}
		// dd($luongtru);
		$total = 0;
		foreach ($luongtru as $k => $v) {
			$total = $total + $v;
		}
		return $total;
	}
	public static function saveStore($input, $kcs = null)
	{
		if ($kcs) {
			return true;
		}
		$model = self::getProductCategoryId($input['id_the_loai']);
		if ($model[1] == 1) {
			$modelName = 'Product';
		}
		if ($model[1] == 2) {
			$modelName = 'ProductCategory';
		}
		$modelId = $model[0];
		$warehouseId = $input['id_kho'];
		
		$cal = StorageLoss::where('model_id', $modelId)
			->where('model_name', $modelName)
			->where('warehouse_id', $warehouseId)
			->first();
		// dd($cal->toArray());
		//neu kho da co sp thi tinh toan cong(tru) va neu kho chua co sp day thi tao moi
		if ($cal) {
			//id_kieu_can : 1,2,3,4 tuc la xuat kho, nhap kho, chueyn xuat kho, chuyen nhap kho
			if ($input['id_kieu_can'] == 2) {
				$weight = $input['kl_hang'] + $cal->weight;
				$cal->update(['weight' => $weight]);
			}
			if ($input['id_kieu_can'] == 1) {
				$weight = $cal->weight - $input['kl_hang'];
				$cal->update(['weight' => $weight]);
			}
			//TODO
			if ($input['id_kieu_can'] == 4) {
				// TH1 : khoi luong hang != 0
				//update total weight
				$weight = $input['kl_hang'] + $cal->weight;
				$cal->update(['weight' => $weight]);
				$dataCheck = ScaleKCS::where('number_ticket', $input['number_ticket_manual'])
					->where('process', 0)
					->orderBy('id', 'DESC')
					->first();
				if ($input['kl_hang'] != '0' && isset($dataCheck) && $dataCheck->package_weight == '0') {
					//check ngược mã phiếu trên kho nguồn ( bằng number_ticket_manual) có khối lượng hay ko
					//nếu không có thì lấy số lượng được cộng trừ vào kho nguồn
						$source = StorageLoss::find($dataCheck->department_id);
						$source->weight = $source->weight - $input['kl_hang'];
						$source->save();
						self::updateProcessScaleKcs($input, 'number_ticket_manual');
				}
				if ($input['kl_hang'] == '0') {
					$dataCheckProcess = ScaleKCS::where('number_ticket', $input['number_ticket_manual'])
						->where('process', 1)
						->orderBy('id', 'DESC')
						->first();
					if ($dataCheckProcess) {
						$cal->update(['weight' => $dataCheckProcess->package_weight + $cal->weight]);
					}
				}
			}

			if ($input['id_kieu_can'] == 3) {
				//tru kho goc
				//truong hop 1: chuyển xuất mà cân ở gốc
				$weight = $cal->weight - $input['kl_hang'];
				$cal->update(['weight' => $weight]);
				if ($input['kl_hang'] > 0) {
					self::updateProcessScaleKcs($input, 'number_ticket');
				}
			}
			//kieu 6  = chuyen tiep kho noi bo, 5 = chuyen tiep kho ngoai, 7 = can ho
			//TODO
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
	public static function updateProcessScaleKcs($input, $field)
	{
		ScaleKCS::where('number_ticket', $input[$field])
			->where('process', 0)
			->update(['process' => 1]);
		return true;
	}

	public static function getNameProduct($stringIdCategory)
	{
		$model = self::getProductCategoryId($stringIdCategory);
		if ($model[1] == PRODUCT) {
			$modelName = 'Product';
		}
		if ($model[1] == PRODUCTCATEGORY) {
			$modelName = 'ProductCategory';
		}
		return $modelName;
		$modelId = $model[0];
		$ob = $modelName::find($modelId);
		return $ob->name;
	}

	public static function savePercent($scale)
	{
		$model = CommonNormal::getProductCategoryId($scale->category_id);
        if ($model[1] == 1) {
            $modelName = 'Product';
        }
        if ($model[1] == 2) {
            $modelName = 'ProductCategory';
        }
        $modelId = $model[0];
        // get list key config
        $config = OverloadRatio::where('model_name', $modelName)
        						->where('model_id', $modelId)
    							->orderBy('id', 'DESC')->first();
		foreach ($config->data as $key => $value) {
			$keyConfig = $key;
	        if ($scale->campaign_code == null) {
	        	$one = self::getVarOne($modelName, $modelId, $scale, $keyConfig);
	        } else {
	        	$listNumberTicketByCampaign = ScaleKCS::where('campaign_code', $scale->campaign_code)->list('number_ticket');
	        	$one = self::getCampaignAveragePercent($listNumberTicketByCampaign, $keyConfig, $modelName, $modelId, $scale);
	        }
	        
	        $two = self::getVarTwo($keyConfig, $modelName, $modelId, $warehouseId);
	        $warehouseWeight = self::getWarehouseWeight($modelName, $modelId, $scale->warehouse_id);
	        $packageWeight = self::getPackageWeight($modelName, $modelId, $scale->warehouse_id);
	        $newPercentDoKho = ($one + $two) / ($packageWeight + $warehouseWeight);



	        $percent = PercentWarehouse::where('model_name', $modelName)
	                    ->where('model_id', $modelId)
	                    ->orderBy('id', 'DESC')
	                    ->first();
	        if (!$percent) {
	            dd('Không tồn tại phần trăm');
	        }
	        $percent->$keyConfig = $newPercentDoKho;
	        $percent->save();
		}
        
        return true;
        /*$percent = PercentWarehouse::where('model_name', $modelName)
                    ->where('model_id', $modelId)
                    ->orderBy('id', 'DESC')
                    ->first();
        if (!$percent) {
            $percentDoKho = 0;
        } else {
            $percentDoKho = $percent->do_kho;
        }
        $storageLoss = StorageLoss::where('model_name', $modelName)
                    ->where('model_id', $modelId)
                    ->where('warehouse_id', $scale->warehouse_id)
                    ->orderBy('id', 'DESC')
                    ->first();



        $newPercentDoKho = ($scale->package_weight * $kcs->do_kho + $storageLoss->weight * $percentDoKho ) / $storageLoss->weight + $scale->package_weight;
        $percent->do_kho = $newPercentDoKho;
        $percent->save();*/
	}

	/**
	 * lấy khối lượng hàng * phần trăm độ ẩm
	 */
	public function getVarOne($modelName, $modelId, $scale, $keyConfig)
	{
		$percent = self::getPercentKCS($keyConfig, $modelName, $modelId, $scale->warehouse_id);
        $weight = self::getPackageWeight($scale->number_ticket, $scale->campaign_code);
        return $weight * $percent;
	}

	/**
	 * lấy khối lượng kho * phần trăm độ ẩm trong bảng percent
	 */
	public function getVarTwo($keyConfig, $modelName, $modelId, $warehouseId)
	{
        $percent = self::getPercent($keyConfig, $modelName, $modelId, $warehouseId);
        $storageLoss = StorageLoss::where('model_name', $modelName)
                    ->where('model_id', $modelId)
                    ->where('warehouse_id', $warehouseId)
                    ->orderBy('id', 'DESC')
                    ->first();
        if (!$storageLoss) {
        	dd('Không tồn tại sản phẩm trong kho');
        }
		return $storageLoss->weight * $percent;
	}

	/**
	 * phần trăm độ ẩm trong bảng percent
	 */
	public function getPercent($keyConfig, $modelName, $modelId, $warehouseId)
	{
		$percent = 0;
		$data = PercentWarehouse::where('model_name', $modelName)
                    ->where('model_id', $modelId)
                    ->orderBy('id', 'DESC')
                    ->first();
        if ($data) {
            $percent = $percent->$keyConfig;
        }
        return $percent / 100;
	}

	/**
	 * phần trăm kiểm định cho phiếu cân
	 */

	public function getPercentKCS($keyConfig, $numberTicket, $campaignCode = null)
	{
        $data = ScaleKCS::where('number_ticket', $numberTicket);
		if ($campaignCode) {
			$data = $data->where('campaign_code');
		}
        $data = $data->whereNotNull('type')
        			->orderBy('id', 'DESC')
                    ->first();
        if (!$data) {
        	dd('Không tồn tại kiểm định');
        }
        
		return $data->$keyConfig / 100;
	}

	/**
	 * lấy khối lượng kho
	 */
	public function getWarehouseWeight($modelName, $modelId, $warehouseId)
	{
		$weight = 0;
        $storageLoss = StorageLoss::where('model_name', $modelName)
                    ->where('model_id', $modelId)
                    ->where('warehouse_id', $warehouseId)
                    ->orderBy('id', 'DESC')
                    ->first();
        if ($storageLoss) {
        	$weight = $storageLoss->weight;
        }
		return $weight;
	}

	/**
	 * lấy khối lượng hàng
	 */
	public function getPackageWeight($keyConfig, $numberTicket, $campaignCode = null)
	{
        $data = ScaleKCS::where('number_ticket', $numberTicket);
		if ($campaignCode) {
			$data = $data->where('campaign_code');
		}
        $data = $data->where('package_weight', '>', 0)
        			->whereNull('type')
        			->orderBy('id', 'DESC')
                    ->first();
        if (!$data) {
        	dd('Không tồn tại cân');
        }
		return $data->package_weight;
	}

	/**
	 * lấy tổng khối lượng hàng cân chiến dịch
	 */
	public function getTotalPackageWeightCampaign($keyConfig, $numberTicket, $campaignCode = null)
	{
        $data = ScaleKCS::where('number_ticket', $numberTicket);
		if ($campaignCode) {
			$data = $data->where('campaign_code');
		}
        $data = $data->where('package_weight', '>', 0)
        			->whereNull('type')
        			->orderBy('id', 'DESC')
                    ->get();
        if (count($data) <= 0) {
        	dd('Không tồn tại cân');
        }
        $total = 0;
        foreach ($data as $key => $value) {
        	$total = $total + $value->package_weight;
        }
		return $total;
	}

	/**
	 * lấy phần trăm trung bình chiến dịch
	 */
	public function getCampaignAveragePercent($arrNumberTicket, $keyConfig, $modelName, $modelId, $scale)
	{
		foreach ($arrNumberTicket as $numberTicket) {
			$scale =  ScaleKCS::where('number_ticket', $numberTicket)
								->where('package_weight', '>', 0)
								->whereNull('type')
								->where('model_name', $modelName)
								->where('model_id', $modelId)
								->where('warehouse_id', $scale->warehouse_id)
								->orderBy('id', 'DESC')
								->first();
			$kcs =  ScaleKCS::where('number_ticket', $numberTicket)
								->whereNotNull('type')
								->orderBy('id', 'DESC')
								->first();
			$arrOne[] = $scale->package_weight * $kcs->$keyConfig;
			$arrTwo[] = $scale->package_weight;
		}
		$one = 0;
        foreach ($arrOne as $value) {
        	$one = $one + $value;
        }
		$two = 0;
        foreach ($arrTwo as $value) {
        	$two = $two + $value;
        }
        return $one / $two;
	}
}