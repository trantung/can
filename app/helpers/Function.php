<?php

/* mm/dd/yyyy to Y-m-d H:i:s */
function convertDateTime($dateString, $paramString = '/')
{
	return $dateString . ' 00:00:00';
	// $array = explode($paramString,$dateString);
	// $datetime = $array[2].'-'.$array[0].'-'.$array[1].' 00:00:00';
	// return $datetime;
}
function getRole($roleId) {
	$role = array(
		ADMIN => 'ADMIN',
		EDITOR => 'EDITOR',
		// SEO => 'SEO',
	);
	return $role[$roleId];
}

function selectRoleId()
{
	return array(
		'' => '-- Lựa chọn',
		ADMIN => 'ADMIN',
		EDITOR => 'EDITOR',
		// SEO => 'SEO',
	);
}

function textParentCategory($input, $isSeoMeta = NULL, $id = NULL)
{
	if(!Admin::isSeo() || $isSeoMeta) {
		return array('placeholder' => $input, 'class' => 'form-control','id' => $id);
	} else {
		return array('placeholder' => $input, 'class' => 'form-control', 'readonly' => true,'id' => $id);
	}
}

function returnList($className)
{
	$list = $className::lists('name', 'id');
	return $list;
}
function returnCss()
{
	return array(
			'fa fa-rocket' => 'Sứ mệnh',
			'fa fa-road' => 'Tầm nhìn',
			'fa fa-key' => 'Giá trị cốt lõi',
		);
}
function returnPosition()
{
	return array(
			1 => 'Trái',
			2 => 'Giữa',
			3 => 'Phải',
		);
}

function getIpAddress()
{
	$ip = $_SERVER['REMOTE_ADDR'];
	return $ip;
}

//add time to filename
function changeFileNameImage($filename)
{
	$file = getFilename($filename);
	$str = strtotime(date('Y-m-d H:i:s'));
	$fileNameAfter = $file. '-' . $str;
	$extension = getExtension($filename);
	return $fileNameAfter.'.'.$extension;
}

function selectStatusGame()
{
	return array(
		ENABLED => 'Đã đăng',
		DISABLED => 'Chưa đăng'
	);
}

//get status game
function getStatusGame($status) {
	$statusGame = array(
		ENABLED => 'Đã đăng',
		DISABLED => 'Chưa đăng'
	);
	return $statusGame[$status];
}

function getNameDevice($deviceId)
{
	if ($deviceId == MOBILE) {
		return SMART_DEVICE;
	}
	if ($deviceId == COMPUTER) {
		return COMPUTER_DEVICE;
	}
}

function getPositionAdvertise($position)
{
	if ($position == HEADER) {
		return 'Header';
	}
	if ($position == Footer) {
		return 'Footer';
	}
	if ($position == CHILD_PAGE) {
		return 'Content';
	}
	if ($position == CHILD_PAGE_RELATION) {
		return 'Content';
	}
}
function getStatusAdvertise($status)
{
	if ($status == ENABLED) {
		return 'Hiển thị';
	}
	if ($status == DISABLED) {
		return 'Ẩn';
	}
}

// show 0 for null
function getZero($number = null)
{
	if($number != '') {
		return $number;
	}
	return 0;
}
//get extension from filename
function getExtension($filename = null)
{
	if($filename != '') {
		return pathinfo($filename, PATHINFO_EXTENSION);
	}
	return null;
}
//get filename from filename
function getFilename($filename = null)
{
	if($filename != '') {
		return pathinfo($filename, PATHINFO_FILENAME);
	}
	return null;
}
//cut trim text
function limit_text($text, $len) {
    if (strlen($text) < $len) {
        return $text;
    }
    $text_words = explode(' ', $text);
    $out = null;
    foreach ($text_words as $word) {
        if ((strlen($word) > $len) && $out == null) {

            return substr($word, 0, $len) . "...";
        }
        if ((strlen($out) + strlen($word)) > $len) {
            return $out . "...";
        }
        $out.=" " . $word;
    }
    return $out;
}
//check file exist
function remoteFileExists($url) {
    $curl = curl_init($url);

    //don't fetch the actual page, you only want to check the connection is ok
    curl_setopt($curl, CURLOPT_NOBODY, true);

    //do request
    $result = curl_exec($curl);

    $ret = false;

    //if request did not fail
    if ($result !== false) {
        //if request was ok, check response code
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200) {
            $ret = true;
        }
    }

    curl_close($curl);

    return $ret;
}

function checkActive($uri = '')
{
	$lang = LaravelLocalization::setLocale();
	if($lang == NULL) {
		$segment = Request::segment(1);
		if ($segment == $uri) {
			return 'class = "active"';
		}
	} else {
		$segment2 = Request::segment(2);
		if ($segment2 == $uri) {
			return 'class = "active"';
		}
	}
	return;
}

function selectActive()
{
	return array(
		ACTIVE => ACTIVEUSER,
		INACTIVE => INACTIVEUSER,
	);
}
/* Y-m-d H:i:s to d-m-Y H:i:s */
function showDateTime($dateString = null)
{
	if($dateString == null) {
		return false;
	}
	$array = explode(' ', $dateString);
	$dmY = explode('-', $array[0]);
	$His = explode(':', $array[1]);
	$datetime = $dmY[2].'-'.$dmY[1].'-'.$dmY[0].' '.$His[0].':'.$His[1];
	return $datetime;
}

function getCount($count)
{
	if($count < 5) {
		return $count;
	}
	return 5;
}

function selectLang()
{
	return array(
		LANG_VI => 'Tiếng việt',
		LANG_EN => 'Tiếng anh',
	);
}
function returnObjectLanguage($langObject, $lang, $modelName)
{
	if ($lang == 'vi') {
		return $modelName::find($langObject->model_id);
	}
	if ($lang == 'en') {
		return $modelName::find($langObject->relate_id);
	}
	// return $modelName::find($langObject->model_id);
}
function getNameStatus($status)
{
	if ($status == 1) {
		return 'Không hiển thị';
	}
	if ($status == 2) {
		return 'Hiển thị';
	}
}
function getLang()
{
	$lang = LaravelLocalization::setLocale();
	if($lang == NULL || $lang == 'vi') {
		return 'vi';
	}
	return $lang;
}
function getTypeLanguage($vi, $en)
{
	$lang = LaravelLocalization::setLocale();
	if ($lang != LANG_EN) {
		return $vi;
	}
	return $en;
}

function removeTagsHtml($text)
{
	$text = strip_tags($text);
	$text = html_entity_decode($text);
	return $text;
}

function getMarryStatus()
{
    return array(
        '0'=>'Tình trạng hôn nhân',
        'Y'=>'Chưa kết hôn',
        'N'=>'Đã kết hôn',
        'O'=>'Không rõ',
        );
}

function getSex()
{
    return array(
        '0'=>'Giới tính',
        'M'=>'Nam',
        'F'=>'Nữ',
        'O'=>'Khác',
        );
}

function checkBoxChecked($roleId, $perId, $model, $type = null) 
{
	$check = $model::where($type, $roleId)
		->where('permission_id', $perId)
		->first();
	if ($check) {
		return true;
	}
	
}

function getChecked($userId, $roleId, $model) 
{
	$check = $model::where('role_id',$roleId)
		->where('user_id', $userId)
		->first();
	if ($check) {
		return true;
	}
}
//haind
function isChecked($model, $field1, $value1, $field2, $value2)
{
	if ($model::where($field1,$value1)->where($field2, $value2)->exists()) {
		return true;
	}
	return false;
}
function calculatorProductAuto($productCategoryId, $productId, $weight, $warehouseId)
{
	$ob = ProductManage::where('product_id', $productId)
		->where('product_category_id', $productCategoryId)
		->first();
	if ($ob) {
		$ratio = $ob->ratio;
		$ratio = 100 - $ratio;
	}
	else {
		$ratio = 100;
	}
	$productWeight = $weight * $ratio/100;
	$obStorage = StorageLoss::where('warehouse_id', $warehouseId)
		->where('model_name', 'Product')
		->where('model_id', $productId)
		->first();
	if ($obStorage) {
		$ratioStorage = $obStorage->ratio;
		$ratioStorage = 100 - $ratioStorage;
		$weightStorage = $ratioStorage * $productWeight/100;
		return $weightStorage;
	}
	else {
		$ratioStorage = 100;
	}
	$weightStorage = $ratioStorage * $productWeight/100;
	return $weightStorage;
}
function getCodeAuto($value, $model)
{
	$ob = $model::orderBy('id', 'desc')->first();
	if ($ob) {
		return $value . ($ob->id +1);
	}
	return $value. '1';
}
function getCodeDependAuto($modelName, $value, $modelDepend, $fieldDepend, $codeFieldDepend)
{
	$input = Input::all();
	$idDepend = $input[$fieldDepend];
	$obDepend = $modelDepend::find($idDepend);
	$codeDepend = $obDepend->$codeFieldDepend;
	$ob = $modelName::orderBy('id', 'desc')->first();
	if (!$ob) {
		$code = $codeDepend . '_' . $value . '1';
		return $code;
	}
	$code = $codeDepend . '_' . $value . ($ob->id +1);
	return $code;
}

function calculatorLoss($modelName, $array)
{
	$ob = $modelName::where($array)->first();
	if ($ob) {
		return $ob->ratio;
	}
	return 0;
}
function calculatorWeightAfter($weight, $value)
{
	$weightAfter = $weight * $value;
	return $weightAfter;
}
function calculatorStorage($warehouseOriginId, $productId, $weight, $status, $warehouseOriginTargetId = null)
{
	//Tu SX
	//trừ kho có nguyên liệu
	if ($status == 6) {
		$ob = StorageLoss::where('warehouse_id', $warehouseOriginId)
			->where('model_name', 'ProductCategory')
			->where('model_id', $productId)
			->first();
		if ($ob) {
			$weightStorage = $ob->weight;
			$ob->update(['weight' => ($weightStorage - $weight)]);
			return true;
		}
		// $id = StorageLoss::create(['warehouse_id' => $warehouseOriginId, 
		// 	'model_name' => 'ProductCategory',
		// 	'model_id' => $productId,
		// 	'weight' => $weight
		// ]);
		return false;
	}

	//Cộng vào kho có thành phẩm
	if ($status == 7) {
		$ob = StorageLoss::where('warehouse_id', $warehouseOriginTargetId)
			->where('model_name', 'Product')
			->where('model_id', $productId)
			->first();
		if ($ob) {
			$weightStorage = $ob->weight;
			$ob->update(['weight' => ($weightStorage + $weight)]);
			return true;
		}
		$id = StorageLoss::create(['warehouse_id' => $warehouseOriginTargetId, 
			'model_name' => 'Product',
			'model_id' => $productId,
			'weight' => $weight
		]);
		return true;
	}
}

function getNameOfTransfer($type)
{
	if ($type == 1) {
		$name = 'Xuất kho';
	}
	if ($type == 2) {
		$name = 'Nhập kho';
	}
	if ($type == 3) {
		$name = 'Chuyển Xuất kho';
	}
	if ($type == 4) {
		$name = 'Chuyển nhập kho';
	}
	return $name;
}

function getTotalCustomerInGroup($customerId)
{
	if (!$groupId) {
		return null;
	}
	$total = CustomerManage::where('customer_group_id', $groupId)->get();
	return count($total);
}
function getDepartmentByScale($code)
{
	if (!$code) {
		return null;
	}
	$ob = ScaleStation::where('code', $code)->first();
	if (!$ob) {
		return 'không có chi nhánh có mã trạm cân này';
	}
	$departmentId = $ob->department_id;
	$company = Company::find($departmentId);
	if (!$company) {
		return 'Chi nhánh không tồn tại hoặc bị xoá';
	}
	return $company->name;
}

function getGroupByCustomer($customerId)
{
	if (!$customerId) {
		return null;
	}
	$ob = CustomerManage::where('customer_id', $customerId)->first();
	if (!$ob) {
		return null;
	}
	$group = CustomerGroup::find($ob->customer_group_id);
	if (!$group) {
		return 'Không có nhóm khách hàng';
	}
	return $group->name;
}



