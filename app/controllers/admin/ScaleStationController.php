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
        $model = new ScaleKCS();
        if (isset($input['from_date']) && $input['from_date'] != '') {
            $start = $input['from_date'];
            $model = $model->where('scale_at', '>=', $start);
        }
        if (isset($input['to_date']) && $input['to_date'] != '') {
            $end = $input['to_date'];
            $model = $model->where('scale_at', '<=', $end);
        }
        // if (isset($input['type_scale']) && $input['type_scale'] == '1') {
        //     $model = $model->where('campaign_code', '');
        // } else {
        //     $model = $model->where('campaign_code', '!=', '');
        // }
        $input = self::processData($input);
        if (count($input) > 0) {
            $model = $model->where($input);
        }
        if ($type == 'campaign') {
            $model = $model->whereNotNull('campaign_code');
        } else {
            $model = $model->whereNull('campaign_code');
        }
        $dataScale = $model->whereNull('type')->where('package_weight', '>', 0)->distinct('number_ticket')->get();
        $dataKcs = ScaleKCS::where('type', 'KCS')->distinct('number_ticket')->get();
        $arrScale = [];
        $arrKcs = [];
        $data = [];
        foreach ($dataScale as $key => $value) {
            $arrScale[$value['number_ticket']] = $value;
        }
        foreach ($dataKcs as $key => $value) {
            $arrKcs[$value['number_ticket']] = $value;
        }
        foreach ($arrScale as $key => $value) {
            $data[$key] = new stdClass();
            $data[$key] = $value;
            if (isset($arrKcs[$key])) {
                $data[$key]->weight_total = ($value->weight_total == null) ? $value->weight_total = $arrKcs[$key]->weight_total : '';
                $data[$key]->trong_luong_mun = ($value->trong_luong_mun == null) ? $value->trong_luong_mun = $arrKcs[$key]->trong_luong_mun : '';
                $data[$key]->trong_luong_qua_co = ($value->trong_luong_qua_co == null) ? $value->trong_luong_qua_co = $arrKcs[$key]->trong_luong_qua_co : '';
                $data[$key]->trong_luong_vo = ($value->trong_luong_vo == null) ? $value->trong_luong_vo = $arrKcs[$key]->trong_luong_vo : '';
                $data[$key]->trong_luong_tap_chat = ($value->trong_luong_tap_chat == null) ? $value->trong_luong_tap_chat = $arrKcs[$key]->trong_luong_tap_chat : '';
                $data[$key]->ty_le_mun = ($value->ty_le_mun == null) ? $value->ty_le_mun = $arrKcs[$key]->ty_le_mun : '';
                $data[$key]->ty_le_qua_co = ($value->ty_le_qua_co == null) ? $value->ty_le_qua_co = $arrKcs[$key]->ty_le_qua_co : '';
                $data[$key]->ty_le_vo = ($value->ty_le_vo == null) ? $value->ty_le_vo = $arrKcs[$key]->ty_le_vo : '';
                $data[$key]->ty_le_tap_chat = ($value->ty_le_tap_chat == null) ? $value->ty_le_tap_chat = $arrKcs[$key]->ty_le_tap_chat : '';
                $data[$key]->do_kho = ($value->do_kho == null) ? $value->do_kho = $arrKcs[$key]->do_kho : '';
            }
        }
        Session::put('statistic', $data);
        return View::make('admin.scale-station.statistic')->with(compact('data', 'type'));
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
        if (Input::get('type_search') == '1') {
            $inputSearch['number_ticket'] = Input::get('search');
            $scale = ScaleKCS::where('number_ticket', $inputSearch['number_ticket'])->whereNull('type')->where('package_weight', '>', 0)->first();
            $logKcs = ScaleKCS::where($inputSearch)->get();
        } else {
            $inputSearch['campaign_code'] = Input::get('search');
            $scale = ScaleKCS::where('campaign_code', $inputSearch['campaign_code'])->whereNull('type')->where('package_weight', '>', 0)->first();
            $logKcs = ScaleKCS::where('code', $input['code'])
                ->where('type', 'KCS')
                ->get();
        }
        $inputSearch['type'] = 'KCS';
        $company = Company::find($input['company_id']);
        if (!$company) {
            dd('Company not found!!');
        }
        $department = Company::where('code', $input['code'])->first();
        if (!$company) {
            dd('Department not found!!');
        }
        $productName = '';
        $campaignCode = '';
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
        $listData = Session::get('statistic');
        $data = $listData[$numberTicket];
        return View::make('admin.scale-station.detail')->with(compact('data'));
    }

    public function getPercent($warehouseId)
    {
        $data = PercentWarehouse::where('warehouse_id', $warehouseId)->first();
        $model = $data->model_name;
        $data->item = $model::find($data->model_id);
        return View::make('admin.scale-station.percent')->with(compact('data'));
    }
}
