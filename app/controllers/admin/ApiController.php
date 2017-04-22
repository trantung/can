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

}
