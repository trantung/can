<?php

class ApiController extends BaseController {

    public function getAllDepartmentByLevel($level = null)
    {
        if (!$level) {
            $level = 3;
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
        if ($codeScaleStation) {
            $data['company'] = Company::where('level', 2)->first();
            $data['scale_station'] = ScaleStation::where('app_id', $appId)
                        ->where('code', $codeScaleStation)
                        ->first();
            if ($data['scale_station']) {
                $data['department'] = Company::find($data['scale_station']->id);
            }

        }
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
        $data = Company::where('level', 3)->with('warehouse')->get();
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
        ScaleManage::where('scale_station_code', $scale_station_code)
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

}