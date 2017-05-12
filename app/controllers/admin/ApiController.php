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

    public function postStoreShip()
    {
        $input = Input::except('_token');
        $id = CustomerShip::create($input);
        if ($id) {
            $response['code'] = 200;
            $response['message'] = 'success';
        } else {
            $response['code'] = 500;
            $response['message'] = 'fail';
        }
        return Response::json($response);
    }


    /**
     * api install scale station
     */
    public function getInstall($appId, $codeScaleStation)
    {
        $data = [];
        if ($codeScaleStation) {
            $data['scale_station'] = ScaleManage::where('app_id', $appId)
                        ->where('scale_station_code', $codeScaleStation)
                        ->first();
            if ($data['scale_station']) {
                // $data['department'] = Company::find($data['scale_station']->id);
                $response['code'] = 200;
                $response['message'] = 'không cài được do tồn tại app_id';
                return Response::json($response);
            }
        }
        $id = ScaleManage::create(['scale_station_code' => $codeScaleStation, 'app_id' => $appId, 'active' => 1])->id;
        // $dataInsert['scale_station_code'] = $codeScaleStation;
        // $dataInsert['app_id'] = $appId;
        // $dataInsert['active'] = ACTIVE;
        // ScaleManage::create($dataInsert);
        $scaleCode = ScaleManage::find($id)->scale_station_code;
        $scale = ScaleStation::where('code', $scaleCode)->first();

        $data['scale_station'] = $scale;
        $data['department'] = $department = Company::find($scale->department_id);
        $data['company'] = Company::find($department->parent_id);
        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $data;
        return Response::json($response);
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
        /**
         * log cân
         *  insert log cân
         */

        /**
         * log kiểm định
         */
       
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

    public function getStorageLoss($productCategoryId, $productId)
    {
        $response['code'] = 200;
        $response['data'] = calculatorLoss('ProductManage', ['product_id' => $productId, 'product_category_id' => $productCategoryId]);
        return Response::json($response);
    }
    public function getProductionLoss($productCategoryId, $productId, $weight, $warehouseId)
    {
        $response['code'] = 200;
        $response['data'] = calculatorProductAuto($productCategoryId, $productId, $weight, $warehouseId);
        return Response::json($response);
    }

}
