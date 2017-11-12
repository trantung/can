<?php

use Barryvdh\DomPDF\Facade as PDF;

class ScaleStationController extends BaseCategoryController {


    protected $model;


    const ZERO       = 0;
    const ONE        = 1;
    // field of contract table.
    const ID              = 'id';
    const NAME            = 'name';
    const CRETED_BY       = 'created_by';
    const UPDATED_BY      = 'created_by';
    const DELETED         = 'deleted';
    const DEPARTMENT_ID   = 'department_id';
    const DESCRIPTION     = 'description';


    function __construct(){
        $this->model = $this->getModel();
    }


    /**
    * return module name. use for check permission.
    *
    * @return array
    */
    protected function getModel()
    {
        return new ScaleStation;
    }

    /**
    * return field before validator and store.
    *
    * @return array
    */
    protected function getInputFieldStore(){
        return Input::only(self::NAME, self::DEPARTMENT_ID);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(self::NAME, self::DEPARTMENT_ID);
    }

    /**
    * return field before update.
    * @param model
    * @return model
    */
    protected function updateMoreData($model){
        return $model;
    }

    /**
    * check field exit update.
    *
    * @return boolean.
    */
    protected function relationFieldUpdateExit(){
        return true;
    }

    /**
    * check field exit delete.
    *
    * @return boolean.
    */
    protected function relationFieldDeleteExit($model){
        return true;
    }

    /**
    * return field before update.
    * @param collection.
    * @return model
    */
    protected function getSubTable(){
        return $this->buildArrayData( Company::orderBy('id', 'asc')->get());
    }

    /**
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    protected function storeValidater(array $array){
        return Validator::make($array,[
            self::NAME => 'required',
        ]);
    }

    /**
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    protected function updateValidater(array $array){
        return Validator::make($array,[
            self::NAME => 'required',
        ]);
    }

    protected function redirectBackAction(){
        return Redirect::action('ScaleStationController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.scale-station.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.scale-station.create';
    }
    protected function viewOfActionShow(){
        return 'admin.scale-station.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.scale-station.edit';
    }

    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->with('department')->paginate(10);
        $subTable = $this->getSubTable();
        return View::make($this->viewOfActionIndex(), ['data'=>$data, 'subTable'=>$subTable]);
    }

    /**
   * [store store new model to db]
   * @return [object] [$model]
   */
    public function store(){
        try{
            $input = $this->getInputFieldStore();
            $validator = $this->storeValidater($input);
            $departmentId = $input['department_id'];
            $obDep = Company::find($departmentId);
            $code = $obDep->code;
            if ($objScale = ScaleStation::orderBy('id', 'DESC')->first()) {
                $input['code'] = $code.'_TC_'. ($objScale->id + 1);
            } else {
                $input['code'] = $code.'_TC_1';
            }
            $input[self::CREATED_BY] = Auth::admin()->get()->id;
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            if($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput($input);
            }
            $id = $this->model->create($input)->id;
            if(!$id) {
                dd('Error');
            }
        } catch(Exception $e){
            return $this->returnError($e);
        }

        return $this->redirectBackAction();
    }

    public function getManage()
    {
        $data = ScaleManage::where('active', ACTIVE)->get();
        return View::make('admin.scale-station.manage')->with(compact('data'));
    }

    public function putDeactive($id)
    {
        ScaleManage::find($id)->update(['active' => 0]);
        return Redirect::action('ScaleStationController@getManage');
    }
    
    public function getStatistic($type = null)
    {
        $input = Input::except('page');
        // dd($input);
        if (
            isset($input['campaign_code']) 
            && isset($input['transfer_type']) 
            && isset($input['warehouse_id'])
            && isset($input['department_id'])
            && isset($input['from_date'])
            && isset($input['to_date'])
            // && isset($input['customer_id'])
            // && isset($input['customer_group_id'])
            ) 
        {
            // dd(111);
            $data = $this->search($input);
            return View::make('admin.scale-station.statistic')->with(compact('data', 'type'));
            
        }
        // dd($input);
        // $model = new ScaleKCS();
        // if (isset($input['from_date']) && $input['from_date'] != '') {
        //     $start = $input['from_date'];
        //     $model = $model->where('scale_at', '>=', $start);
        // }
        // if (isset($input['to_date']) && $input['to_date'] != '') {
        //     $end = $input['to_date'];
        //     $model = $model->where('scale_at', '<=', $end);
        // }
        // if (isset($input['type_scale']) && $input['type_scale'] == '1') {
        //     $model = $model->where('campaign_code', '');
        // } else {
        //     $model = $model->where('campaign_code', '!=', '');
        // }
        // $input = self::processData($input);
        // if (count($input) > 0) {
        //     $model = $model->where($input);
        // }
        if ($type == 'campaign') {
            //get all campaign
            $data = ScaleKCS::where('campaign_code', '!=', '')
                ->groupBy('campaign_code')
                ->get();
            return View::make('admin.scale-station.statistic')->with(compact('data', 'type'));
            // $model = $model->whereNotNull('campaign_code');
        } else {
            // dd($model);
            $data = ScaleKCS::whereNull('campaign_code')->get();
        }
        // $dataScale = $model->whereNull('type')->where('package_weight', '>', 0)->distinct('number_ticket')->get();
        // $dataKcs = ScaleKCS::where('type', 'KCS')->distinct('number_ticket')->get();
        // $arrScale = [];
        // $arrKcs = [];
        // $data = [];
        // foreach ($dataScale as $key => $value) {
        //     $arrScale[$value['number_ticket']] = $value;
        // }
        // foreach ($dataKcs as $key => $value) {
        //     $arrKcs[$value['number_ticket']] = $value;
        // }
        // foreach ($arrScale as $key => $value) {
        //     $data[$key] = new stdClass();
        //     $data[$key] = $value;
        //     if (isset($arrKcs[$key])) {
        //         $data[$key]->weight_total = ($value->weight_total == null) ? $value->weight_total = $arrKcs[$key]->weight_total : '';
        //         $data[$key]->trong_luong_mun = ($value->trong_luong_mun == null) ? $value->trong_luong_mun = $arrKcs[$key]->trong_luong_mun : '';
        //         $data[$key]->trong_luong_qua_co = ($value->trong_luong_qua_co == null) ? $value->trong_luong_qua_co = $arrKcs[$key]->trong_luong_qua_co : '';
        //         $data[$key]->trong_luong_vo = ($value->trong_luong_vo == null) ? $value->trong_luong_vo = $arrKcs[$key]->trong_luong_vo : '';
        //         $data[$key]->trong_luong_tap_chat = ($value->trong_luong_tap_chat == null) ? $value->trong_luong_tap_chat = $arrKcs[$key]->trong_luong_tap_chat : '';
        //         $data[$key]->ty_le_mun = ($value->ty_le_mun == null) ? $value->ty_le_mun = $arrKcs[$key]->ty_le_mun : '';
        //         $data[$key]->ty_le_qua_co = ($value->ty_le_qua_co == null) ? $value->ty_le_qua_co = $arrKcs[$key]->ty_le_qua_co : '';
        //         $data[$key]->ty_le_vo = ($value->ty_le_vo == null) ? $value->ty_le_vo = $arrKcs[$key]->ty_le_vo : '';
        //         $data[$key]->ty_le_tap_chat = ($value->ty_le_tap_chat == null) ? $value->ty_le_tap_chat = $arrKcs[$key]->ty_le_tap_chat : '';
        //         $data[$key]->do_kho = ($value->do_kho == null) ? $value->do_kho = $arrKcs[$key]->do_kho : '';
        //     }
        // }
        // Session::put('statistic', $data);
        return View::make('admin.scale-station.statistic_odd')->with(compact('data', 'type'));
    }

    public function getLogKcs()
    {
        $data = ScaleKCS::where('type', 'KCS')->paginate(PAGINATE);
        return View::make('admin.scale-station.log-kcs')->with(compact('data'));
    }

    public function destroy($id)
    {
        $scale = ScaleStation::find($id);
        if ($scale->app_id > 0) {
            return Redirect::back()->withErrors('Không xoá được trạm cân do đã có app');
        }
        $scale->destroy();
        return Redirect::action('ScaleStationController@index');
    }
    public function postDestroyApp($id)
    {
        $scale = ScaleStation::find($id);
        $scale->update(['app_id' => '']);
        return Redirect::action('ScaleStationController@index');
    }
    public function update($id)
    {
        $input = Input::except('_token');
        $data = ScaleStation::find($id);
        if (isset($data->app_id) && $data->app_id > 0) {
            if ($input['department_id'] != $data->department_id) {
                return Redirect::back()->withErrors('Không sửa được chi nhánh do trạm cân đã có app');
            }
            $obDep = Company::find($input['department_id']);
            $code = $obDep->code;
            $input['code'] = $code.'_TC_'. $objScale->id;
            $data->update($input);
            return Redirect::action('ScaleStationController@index');
        }
    }

    function processData($input = [])
    {
        if (count($input) > 0) {
            foreach ($input as $key => $value) {
                if(in_array($value, ['', VALUE_SELECT_ALL]) || in_array($key, ['to_date', 'from_date', 'type_scale'])){
                    unset($input[$key]);
                }
            }
        }
        return $input;
    }

    public function getSearchExport()
    {
        return View::make('admin.scale-station.search-export');
    }

    public function getExport() {
        $input = Input::all();
        $inputSearch = Input::except('company_id', 'product_category_id', 'type_search', 'search');
        $company = Company::find($input['company_id']);
        if (!$company) {
            dd('Company not found!!');
        }
        $department = Company::find($input['department_id']);
        if (!$department) {
            dd('Department not found!!');
        }
        $productName = '';
        $campaignCode = '';
        // $scale = ScaleKCS::where('number_ticket', $inputSearch['number_ticket'])
        //     ->whereNull('type')
        //     ->where('package_weight', '>', 0)
        //     ->first();
        // if ($scale) {
        //     $modelName = CommonNormal::getNameProduct($scale->category_id);
        //     $product = $modelName::find(CommonNormal::getProductCategoryId($scale->category_id)[0]);
        //     if (!$product) {
        //         $productName = 'Không có sản phẩm';
        //     } else {
        //         $productName = $product->name;
        //     }
        //     if ($scale->campaign_code != '') {
        //         $campaignCode = $scale->campaign_code;
        //     }
        // }
        //neu la can chien dich Input::get('type_search') !=1
        if (Input::get('type_search') != '1') {
        //lay toàn bộ các mã phiếu cân lẻ mà có kcs với mã chiến dịch = mã chiến dịch truyền vào
            //lấy các mã phiếu cân lẻ có mã chiến dịch = mã chiến dịch truyền vào
            $inputSearch['campaign_code'] = Input::get('search');
            $ob = ScaleKCS::where('campaign_code', $inputSearch['campaign_code'])
                ->whereNull('type')
                ->where('code', $inputSearch['code'])
                ->where('package_weight', '>', 0);
            $scaleList = $ob->distinct('number_ticket')->get();
            $scale = $ob->first();
            if ($scale) {
                $modelName = CommonNormal::getNameProduct($scale->category_id);
                $product = $modelName::find(CommonNormal::getProductCategoryId($scale->category_id)[0]);
                if (!$product) {
                    $productName = 'Không có sản phẩm';
                } else {
                    $productName = $product->name;
                }
                if ($scale->campaign_code != '') {
                    $campaignCode = $scale->campaign_code;
                }
            }
                // ->get();
            //loại bỏ những mã phiếu cân lẻ mà ko có kcs
            $logKcs = [];
            foreach ($scaleList as $key => $value) {
                $kcs = ScaleKCS::where('number_ticket', $value->number_ticket)
                    ->where('type', 'KCS')
                    ->orderBy('id', 'desc')
                    ->first();
                if (!$kcs) {
                     unset($kcs[$key]);
                } else {
                //lấy kcs cuối cùng cho phiếu cân đấy   
                    $logKcs[] = $kcs;
                }
                
            }
        }


        // if (Input::get('type_search') == '1') {
        //     $inputSearch['number_ticket'] = Input::get('search');
        //     $scale = ScaleKCS::where('number_ticket', $inputSearch['number_ticket'])->whereNull('type')->where('package_weight', '>', 0)->first();
        //     $logKcs = ScaleKCS::where($inputSearch)->get();
        // } else {
        //     // $inputSearch['campaign_code'] = Input::get('search');

        //     // $scale = ScaleKCS::where('campaign_code', $inputSearch['campaign_code'])->whereNull('type')->where('package_weight', '>', 0)->first();
        //     // dd($scale);
        //     // $logKcsList = ScaleKCS::where('code', $input['code'])
        //     //     ->where('type', 'KCS')
        //     //     ->select('number_ticket')
        //     //     ->distinct('number_ticket')
        //     //     ->get();
        //     // $logKcs = [];
        //     // foreach ($logKcsList as $key => $value) {
        //     //     $logKcs[] = ScaleKCS::where('code', $input['code'])
        //     //         ->where('type', 'KCS')
        //     //         ->where('number_ticket', $value->number_ticket)
        //     //         ->orderBy('id', 'desc')
        //     //         ->first();
        //     // }
        // }
        $inputSearch['type'] = 'KCS';
        // $company = Company::find($input['company_id']);
        // if (!$company) {
        //     dd('Company not found!!');
        // }
        // $department = Company::where('code', $input['code'])->first();
        // if (!$company) {
        //     dd('Department not found!!');
        // }
        // $productName = '';
        // $campaignCode = '';
        // if ($scale) {
        //     $modelName = CommonNormal::getNameProduct($scale->category_id);
        //     $product = $modelName::find(CommonNormal::getProductCategoryId($scale->category_id)[0]);
        //     if (!$product) {
        //         $productName = 'Không có sản phẩm';
        //     } else {
        //         $productName = $product->name;
        //     }
        //     if ($scale->campaign_code != '') {
        //         $campaignCode = $scale->campaign_code;
        //     }
        // }
        $data = [
            'company' => $company,
            'department' => $department,
            'product' => $productName,
            'campaignCode' => $campaignCode,
            'log' => $logKcs,
        ];
        $pdf = PDF::loadView('exports.rate', $data);
        return $pdf->stream();
    }

    public function getLogScale()
    {
        $data = ScaleKCS::whereNull('type')->paginate(PAGINATE);
        return View::make('admin.scale-station.log-scale')->with(compact('data'));
    }

    public function getDetail($numberTicket)
    {
        // $listData = Session::get('statistic');
        // $data = $listData[$numberTicket];
        $data = ScaleKCS::where('number_ticket', $numberTicket)
            ->where('second_scale_weight', '>', 0)
            ->first();
        $kcs = ScaleKCS::where('number_ticket', $numberTicket)
            ->where('type', 'KCS')
            ->first();
        return View::make('admin.scale-station.detail')->with(compact('data', 'kcs'));
    }

    public function getPercent($warehouseId)
    {
        $data = PercentWarehouse::where('warehouse_id', $warehouseId)->first();
        if (!$data) {
            dd('chưa có phần trăm cho kho này');
        }
        $model = $data->model_name;
        $data->item = $model::find($data->model_id);
        return View::make('admin.scale-station.percent')->with(compact('data'));
    }
    public function search($input)
    {
        if (isset($input['campaign_code']) 
            && isset($input['transfer_type']) 
            && isset($input['warehouse_id'])
            && isset($input['department_id'])
            && isset($input['from_date'])
            && isset($input['to_date'])
            && isset($input['customer_id'])
            && isset($input['customer_group_id'])
            ) 
        {
            $data = ScaleKCS::where('campaign_code', '!=', '')
                ->where(function ($query) use ($input) {
                if($input['customer_group_id']) {
                    $customerShipListId = CustomerManage::where('customer_group_id', $input['customer_group_id'])
                        ->lists('customer_id');
                    $customerListId = CustomerShip::whereIn('id', $customerShipListId)
                        ->lists('customer_id');
                    // dd($customerListId);
                    $query = $query->whereIn('customer_id', $customerListId);
                }

                if($input['campaign_code']) {
                    $query = $query->where('campaign_code', 'like', '%'.$input['campaign_code'].'%');
                }
                if($input['transfer_type']) {
                    $query = $query->where('transfer_type', $input['transfer_type']);
                }
                if($input['warehouse_id']) {
                    $query = $query->where('warehouse_id', $input['warehouse_id']);
                }
                if($input['department_id']) {
                    $query = $query->where('department_id',  $input['department_id']);
                }
                if($input['customer_id']) {
                    $query = $query->where('customer_id',  $input['customer_id']);;
                }

                if($input['from_date']) {
                    $query = $query->where('created_at', '>=', $input['from_date']);
                }
                if($input['to_date']) {
                    $query = $query->where('created_at', '<=', $input['to_date']);
                }
            })->groupBy('campaign_code')->get();
            // dd($data);
            return $data;
        }
        return null;
    }
    public function showDetail($campaignCode)
    {
        // $data = ScaleKCS::find($id);
        // dd($campaignCode);
        $listScale = ScaleKCS::where('campaign_code', $campaignCode)
            ->where('package_weight', '>', 0)
            // ->distinct('number_ticket')
            ->get();
            // dd($listScale->toArray());
        return View::make('admin.scale-station.scale_campaign_detail')->with(compact('listScale','campaignCode'));
    } 
    public function exportExcel()
    {
        $array1 = [
            'mã chiến dịch',
            'tên chiến dịch', 
            'Nhóm khách hàng', 
            'Khách',
            'Nhóm partner', 
            'Partner', 
            'Kho', 
            'Chi nhánh', 
            'Khối lượng hàng', 
            'Lượng trừ',
            'Số chuyến'
        ];
        $list = ScaleKCS::where('campaign_code', '!=', '')
            ->groupBy('campaign_code')
            ->get();
        Excel::create('Filename', function($excel) use($array1, $list) {
            $excel->sheet('Sheetname', function($sheet) use($array1, $list) {
                $sheet->row(1, $array1);
                $i = 2;
                foreach ($list as $key => $value) {
                    $data = [
                        $value->campaign_code,
                        $value->campaign_name,
                        getCustomerGroup($value),
                        $value->customer_name,
                        getPartnerGroup(),
                        $value->doi_tac_ten,
                        getNameWarehouse($value->warehouse_id),
                        getNameCompany($value->department_id),
                        getWeightTotalCampagin($value->campaign_code),
                        getLuongTruCampaign($value->campaign_code),
                        getSochuyen($value->campaign_code),
                    ];
                    $sheet->row($i, $data);
                    $i++;
                }
            });
        })->export('xls');
    }   

    public function searchDetailCampaign()
    {
        $input = Input::all();
        dd($input);
    }
    public function exportExcelDetailCampaign($campaignCode)
    {
        // dd($campaignCode);
        $list = ScaleKCS::where('campaign_code', $campaignCode)
            ->where('package_weight', '>', 0)
            ->get();
        // dd($list->toArray());
        $array1 = [
            'mã cân',
            'Nhóm khách hàng', 
            'Khách',
            'Nhóm partner', 
            'Partner', 
            'Kho', 
            'Chi nhánh', 
            'Khối lượng hàng', 
            'Lượng trừ',
            'Kiểu cân',
            'Nhân viên cân',
            'Nhân viên KCS',
        ];
        Excel::create('Filename', function($excel) use($array1, $list) {
            $excel->sheet('Sheetname', function($sheet) use($array1, $list) {
                $sheet->row(1, $array1);
                $i = 2;
                foreach ($list as $key => $value) {
                    $data = [
                        $value->number_ticket,
                        getCustomerGroup($value),
                        $value->customer_name,
                        getPartnerGroup(),
                        $value->doi_tac_ten,
                        getNameWarehouse($value->warehouse_id),
                        getNameCompany($value->department_id),
                        getWeightTotalCampagin($value->package_weight),
                        getLuongTruCan($value->number_ticket),
                        Common::getNameKieuCan($value->transfer_type),
                        Common::getNhanviencanKcs($value->id),
                        Common::getNhanviencanKcs($value->id, 'KCS'),
                    ];
                    $sheet->row($i, $data);
                    $i++;
                }
            });
        })->export('xls');
    }
}
