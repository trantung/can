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

    public function postStoreShip($input, $modelName)
    {
        $id = $modelName::create($input)->id;
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
            $data['customer'] = CustomerShip::where('scale_code', $codeScaleStation)->get();
            $response['code'] = 200;
            $response['message'] = 'success';
            $response['data'] = $data;
            //update appid vào bảng scale
            $scale->update(['app_id' => $appId]);
            return Response::json($response);
        }
    }

    public function getCustomerByScaleStation($codeScaleStation)
    {
        $data = CustomerShip::where('scale_code', $codeScaleStation)->get();
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

    public function getWarehouseByAllDepartment($level = null)
    {
        $data = new Company();
        if ($level) {
            $data = $data->where('level', $level);
        }
        $data = $data->with('warehouse')->get();
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
        $data = '';
        $customer = [];
        //check type
        $idLuongtruCan = '';
        if (isset($input['type']) && $input['type'] == 'KCS') {
            $check = KcsLogInstall::where('app_id', $appId)
                ->where('department_code', $scaleCode)
                ->first();
            if (!$check) {
                $response['code'] = 200;
                $response['message'] = 'Không tồn tại Kiểm định trên chi nhánh này';
                $response['data'] = '';
                return Response::json($response);
            }
            $idLuongtruCan = $this->common($input, 1);
            //insert data KCS
            // $data = CommonNormal::storeDataKCS($input);
        } else {
            $check = ScaleStation::where('app_id', $appId)
                ->where('code', $scaleCode)
                ->first();
            $customer['customer_name'] = $input['khach_hang_ten'];
            $customer['customer_phone'] = $input['khach_hang_sdt'];
            $customer['customer_address'] = $input['khach_hang_dia_chi'];
            $customer['customer_id'] = $input['id_kh'];
            $customer['customer_fax'] = $input['khach_hang_fax'];
            $customer['app_code'] = $input['app_id'];
            $customer['scale_code'] = $input['code'];
            $checkCustomer = CustomerShip::where('app_code', $input['app_id'])
                ->where('customer_id', $input['id_kh'])->first();
            if (!$checkCustomer) {
                $this->postStoreShip($customer, 'CustomerShip');
            }

            //luu thong tin partner
            $partner = [];
            $partner['doi_tac_ten'] = $input['doi_tac_ten'];
            $partner['doi_tac_sdt'] = $input['doi_tac_sdt'];
            $partner['doi_tac_dia_chi'] = $input['doi_tac_dia_chi'];
            $partner['doi_tac_fax'] = $input['doi_tac_fax'];
            $partner['partner_id'] = $input['partner_id'];
            $partner['app_code'] = $input['app_id'];
            $partner['scale_code'] = $input['code'];
            $checkPartner = Partner::where('app_code', $input['app_id'])
                ->where('partner_id', $input['partner_id'])->first();
            if (!$checkCustomer) {
                $this->postStoreShip($partner, 'Partner');
            }
            // call store insert customer ship
            if ($input['chien_dich_id'] == '') {
                // dd(11);
                $idLuongtruCan = $this->common($input);
            } else {
                //cân chiến dịch
                $idLuongtruCan = $this->common($input);
            }
            if ($idLuongtruCan) {
                $data = $idLuongtruCan;
            } else {
                $data = '';
            }
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
    public function getCustomerDataByScaleCode($code)
    {
        $response['data'] = CustomerShip::where('scale_code', $code)->get();
        $response['code'] = 200;
        $response['message'] = 'success';
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
    public function common($input, $kcs = null)
    {
        if ($kcs) {
             $id = CommonNormal::storeDataKCS($input);
        } else {
            $id = CommonNormal::storeDataScale($input);
        }
        //tinh khoi luong hang : nếu có lớn hơn 2 lần cân trên 1 mã phiếu
        $obj = ScaleKCS::find($id);
        $scale = ScaleKCS::where('number_ticket', $obj->number_ticket)
            ->whereNull('type')
            ->where('package_weight', '>', 0)
            ->first();
        // if ($secondTicket) {
            //tinh toan luu kho
        CommonNormal::saveStore($input, $kcs);
        //kiểm tra xem đã kiểm định chưa ( KCS): muc dich de in chung thu
        // dd(1111);
        $kcs = ScaleKCS::where('number_ticket', $obj->number_ticket)
            ->where('type', 'KCS')
            ->first();
        if ($kcs) {
            // tính lượng trừ
            $luongtru = CommonNormal::calcLuongTru($scale, $kcs);
            // dd($luongtru);
            //lưu lượng trừ vào 1 bảng
            $inputLuongtru[] = [];
            
            if (!$kcs) {
                $inputLuongtru['ma_cd'] = $input['chien_dich_id'];
                $inputLuongtru['ma_phieu_can'] = $input['so_phieu'];
            }
            else {
                $scale = ScaleKCS::where('number_ticket', $input['soPhieu'])->whereNull('type')->first();
                $inputLuongtru['ma_cd'] = $scale->campaign_code;
                $inputLuongtru['ma_phieu_can'] = $input['soPhieu'];
            }   
            $inputLuongtru['luongtru'] = $luongtru;
            $idLuongtruCan = LuongTruCan::create($inputLuongtru)->id;
        // }
            return $idLuongtruCan;
        }
        return false;
    }
    public function postChangePass()
    {
        // dd(11);
        $input = Input::except('_token');
        $admin = Admin::where('username', $input['user_name']);
        if(!isset($input['old_password']))
        {
            $response['code'] = 200;
            $response['message'] = 'phải nhập password cũ';
            $response['data'] = '';
            return Response::json($response);
        }
        else
        {
            if(!isset($input['new_password']))
            {
                $response['code'] = 200;
                $response['message'] = 'phải nhập password mới';
                $response['data'] = '';
                return Response::json($response);
            }
            if(isset($input['new_password']))
            {
                if(Auth::admin()->attempt(['username' => $input['user_name'], 'password' => $input['old_password']]))
                {
                    $newPass = Hash::make($input['new_password']);
                    $admin->update(['password' => $newPass]);
                    $response['code'] = 200;
                    $response['message'] = 'Cập nhật mật khẩu thành công';
                    $response['data'] = '';
                    return Response::json($response);
                }else{
                    $response['code'] = 200;
                    $response['message'] = 'tên đăng nhập hoặc mật khẩu cũ không đúng';
                    $response['data'] = '';
                    return Response::json($response);
                }
            }
            else
            {
                $response['code'] = 200;
                $response['message'] = 'Phải nhập mật khẩu ';
                $response['data'] = '';
                return Response::json($response);
            }
        }
    }

    public function getConfigKey($modelName, $modelId)
    {
        $data = OverloadRatio::where('model_name', $modelName)->where('model_id', $modelId)->orderBy('id', 'DESC')->first();
        $response['code'] = 200;
        $response['message'] = 'Thành công';
        $response['data'] = $data;
        return Response::json($response);
    }
}
