<?php

class ApiController extends BaseController {

    public function getAllDepartmentByLevel($level = null)
    {
        if (!$level) {
            $level = 4;
        }
        if (Input::has('status')) {
            //status = trạng thái hàng chuyển kho
        }
        $listData = Company::level($level)->with('warehouse')->get();
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $listData;
        return Response::json($response);
    }

    public function getAllProduct()
    {
        $listData = Product::get();
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $listData;
        return Response::json($response);
    }

    public function getAllProductCategory()
    {
        $listData = ProductCategory::get();
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $listData;
        return Response::json($response);
    }

    public function postStoreShip($input)
    {
        $id = CustomerShip::create($input)->id;
        return $id;
    }


    /**
     * api install scale station
     */
    public function getInstall($appId, $codeScaleStation)
    {
        $data = [];
        $id = ScaleManage::create(['scale_station_code' => $codeScaleStation, 'app_id' => $appId, 'active' => 1])->id;
        $scaleCode = $codeScaleStation;
        $scale = ScaleStation::where('code', $scaleCode)->first();
        if (!$scale) {
            $response['code'] = 200;
            $response['message'] = 'không cài được do mã trạm cân sai';
            $response['data'] = '';
            return Response::json($response);
        } else {
            if ($scale->app_id > 0) {
                $response['code'] = 200;
                $response['message'] = 'không cài được do trạm cân đã cài app';
                $response['data'] = '';
                return Response::json($response);
            }
            $scale = $scale;
            $data['scale_station'] = $scale;
            $department = Company::find($scale->department_id);
            $data['department'] = $department;
            $data['company'] = Company::find($department->parent_id);
            $response['code'] = 200;
            $response['message'] = 'success';
            $response['data'] = $data;
            //update appid vào bảng scale
            $scale->update(['app_id' => $appId]);
            return Response::json($response);
        }
    }

    public function getCustomerByScaleStation($appId, $codeScaleStation)
    {
        $arrCustomer = Customer::where('scale_station_code', $codeScaleStation)
                    ->lists('group_id');
        $data = CustomerGroup::whereIn('id', $arrCustomer)->get();
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $data;
        return Response::json($response);
    }

    public function getAllTypeProduct()
    {
        $data['category_product'] = ProductCategory::lists('name', 'id');
        $data['product'] = Product::lists('name', 'id');
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $data;
        return Response::json($response);
    }

    public function getWarehouseByAllDepartment()
    {
        $data = Company::where('level', 4)->with('warehouse')->get();
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $data;
        return Response::json($response);
    }

    /**
     * api install scale station
     */
    public function getReinstallScaleStation($appId, $codeScaleStation)
    {
        ScaleManage::where('scale_station_code', $codeScaleStation)
                    ->where('app_id', $appId)->update(['active', DEACTIVE]);
        $dataInsert['scale_station_code'] = $codeScaleStation;
        $dataInsert['app_id'] = $appId;
        $dataInsert['active'] = ACTIVE;
        ScaleManage::create($dataInsert);
        return true;
    }

    public function postLogScale()
    {
        $input = Input::all();
        $scaleCode = $input['code'];
        $appId = $input['app_id'];
        $check = ScaleStation::where('app_id', $appId)
            ->where('code', $scaleCode)
            ->first();
        $customer = [];
        // dd($input);
        $customer['customer_name'] = $input['khach_hang_ten'];
        $customer['customer_phone'] = $input['khach_hang_sdt'];
        $customer['customer_address'] = $input['khach_hang_dia_chi'];
        $customer['customer_id'] = $input['id_kh'];
        $customer['customer_fax'] = $input['khach_hang_fax'];
        $customer['app_code'] = $input['app_id'];
        $this->postStoreShip($customer);
        //check type
        if (isset($input['type']) && $input['type'] == 'KCS') {
            //insert data KCS
            CommonNormal::storeDataKCS($input);
        } else {
            // call store insert customer ship
            if ($input['chien_dich_id'] == '') {
                $idLuongtruCan = $this->common($input);
            } else {
                //cân chiến dịch
                $idLuongtruCan = $this->common($input);
            }
        }
        if ($idLuongtruCan) {
            $data = $idLuongtruCan;
        } else {
            $data = '';
        }
        if (!$check) {
             $response['code'] = 200;
            $response['message'] = 'trạm cân đã bị xoá app này';
            $response['data'] = '';
            return Response::json($response);
        }
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $data;
        return Response::json($response);
        //nếu tồn tại cả data kiểm định + data cân cùng 1 mã phiếu thì tính số liệu
    }

    public function postLogin()
    {
        $input = Input::all();
        $checkLogin = Auth::admin()->attempt($input);
        if($checkLogin) {
            $response['code'] = 200;
            $response['message'] = 'success';
            $response['data'] = Auth::admin()->get();
            
        } else {
            $response['code'] = 500;
            $response['message'] = 'false';
        }
        return Response::json($response);
    }

    public function getProductionLoss($productCategoryId, $productId)
    {
        $response['code'] = 200;
        $response['data'] = calculatorLoss('ProductManage', ['product_id' => $productId, 'product_category_id' => $productCategoryId]);
        return Response::json($response);
    }

    public function getStorageLoss($warehouseId, $productId)
    {
        $response['code'] = 200;
        $response['data'] = calculatorLoss('StorageLoss', ['model_name' => 'Product', 'model_id' => $productId, 'warehouse_id' => $warehouseId]);
        return Response::json($response);
    }

    public function getResultProductionAuto($productCategoryId, $productId, $weight, $warehouseId)
    {
        $response['code'] = 200;
        $response['data'] = calculatorProductAuto($productCategoryId, $productId, $weight, $warehouseId);
        return Response::json($response);
    }
    public function installKcs($appId, $code)
    {
        //check app_id va code ton tai
        $check = KcsLogInstall::where('app_id', $appId)->where('department_code', $code)->first();
        if ($check) {
            $response['code'] = 200;
            $response['message'] = 'appId và mã chi nhánh đã tồn tại';
            return Response::json($response);
        }
        $data['department'] = $department = Company::where('code', $code)->first();
        if (!$department) {
            $response['code'] = 200;
            $response['message'] = 'mã chi nhánh sai';
            return Response::json($response);
        }
        $data['company'] = $company = Company::find($department->parent_id);
        if (!$company) {
            $response['code'] = 200;
            $response['message'] = 'Chi nhánh bị lỗi';
            return Response::json($response);
        }
        //tao moi KcsLogInstall
        $kcsId = KcsLogInstall::create(['department_code' => $code, 'app_id' => $appId])->id;
        if (!$kcsId) {
            $response['code'] = 200;
            $response['message'] = 'Không tạo mới được kcs';
            return Response::json($response);
        }
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $data;
        return Response::json($response);
    }
    public function common($input)
    {
        $id = CommonNormal::storeDataScale($input);
        //tinh khoi luong hang : nếu có lớn hơn 2 lần cân trên 1 mã phiếu
        $obj = ScaleKCS::find($id);
        $scale = ScaleKCS::where('number_ticket', $obj->number_ticket)
            ->whereNull('type')
            ->where('package_weight', '>', 0)
            ->first();
        // if ($secondTicket) {
            //tinh toan luu kho
        CommonNormal::saveStore($input);
        //kiểm tra xem đã kiểm định chưa ( KCS): muc dich de in chung thu
        $kcs = ScaleKCS::where('number_ticket', $obj->number_ticket)
            ->where('type', 'KCS')
            ->first();
        if ($kcs) {
            // tính lượng trừ
            $luongtru = CommonNormal::calcLuongTru();
            //lưu lượng trừ vào 1 bảng
            $inputLuongtru[] = [];
            $inputLuongtru['ma_cd'] = $input['chien_dich_id'];
            $inputLuongtru['ma_phieu_can'] = $input['code'];
            $inputLuongtru['luongtru'] = $luongtru;
            $idLuongtruCan = LuongTruCan::create($inputLuongtru)->id;
        // }
            return $idLuongtruCan;
        }
        return false;
    }
}
