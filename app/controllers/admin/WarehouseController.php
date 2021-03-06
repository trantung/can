<?php

class WarehouseController extends BaseCategoryController {


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
        $this->beforeFilter('checkPermission', array('except'=>array('login','doLogin','logout')));
        $this->model = $this->getModel();
    }


    /**
    * return module name. use for check permission.
    *
    * @return array
    */
    protected function getModel()
    {
        return new Warehouse;
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
        return Redirect::action('WarehouseController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.warehouse.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.warehouse.create';
    }
    protected function viewOfActionShow(){
        return 'admin.warehouse.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.warehouse.edit';
    }

    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->with('department')->paginate(10);
        $subTable = $this->getSubTable();
        return View::make($this->viewOfActionIndex(), ['data'=>$data, 'subTable'=>$subTable]);
    }

    public function getWarehouseByDepartment($departmentId)
    {
        $data = $this->model->where('department_id', $departmentId)->get();
        if (!$data) {
            dd('Không có kho');
        }
        return Response::json($data);
    }

    public function getWarehouse()
    {
        $data = $this->model->get();
        if (!$data) {
            dd('Không có kho');
        }
        return Response::json($data);
    }
    public function store()
    {
        $input = Input::except('_token');
        $warehouseCode = Warehouse::orderBy('id', 'desc')->first();
        $code = getCodeDependAuto('Warehouse', 'kho', 'Company', 'department_id', 'code');
        $warehouseId = Warehouse::create(['code' => $code,
            'department_id' => $input['department_id'],
            'name' => $input['name'],
        ])->id;
        return Redirect::action('WarehouseController@index');
    }

    public function getStatistic($id)
    {
        $data = StorageLoss::where('warehouse_id', $id)->get();
        // $data = [];
        // foreach ($listItem as $key => $value) {
        //     $data[$key] = new stdClass();
        //     $data[$key] = $value;
        //     $model = $value->model_name;
        //     $data[$key]->item = $model::find($value->model_id);
        // }
        // $data = getStaticPercentWarehouse($id);
        return View::make('admin.warehouse.statistic')->with(compact('data'));
    }

    public function getReset($id)
    {
        $data = StorageLoss::find($id);
        if (!$data) {
            dd('Không tìm thấy dữ liệu');
        }
        $listPercent = PercentWarehouse::where('model_name', $data->model_name)
            ->where('model_id', $data->model_id)
            ->where('warehouse_id', $data->warehouse_id)
            ->first();
        // $data->item = $model::find($data->model_id);
        return View::make('admin.warehouse.form_reset')->with(compact('data', 'listPercent'));
    }

    public function putReset($id)
    {
        $data = StorageLoss::find($id);
        if (!$data) {
            dd('Không có dữ liệu');
        }
        $data->weight = Input::get('weight');
        $data->ratio = Input::get('ratio');
        $data->save();
        return Redirect::action('WarehouseController@index');
    }

    public function postResetPercent($storageLossId)
    {
        $input = Input::all();
        $inputPercent = Input::except('_token', 'weight');
        $data = StorageLoss::find($storageLossId);
        $percent = PercentWarehouse::where('model_name', $data->model_name)
            ->where('model_id', $data->model_id)
            ->where('warehouse_id', $data->warehouse_id)
            ->first();
        // $percent = PercentWarehouse::find($percentId);
        if (!$data) {
            dd('Không tìm thấy dữ liệu');
        }
        if (!$percent) {
            $inputPercent['model_name'] = $data->model_name;
            $inputPercent['model_id'] = $data->model_id;
            $inputPercent['warehouse_id'] = $data->warehouse_id;
            PercentWarehouse::create($inputPercent);
            return Redirect::action('WarehouseController@getStatistic', $data->warehouse_id);
        }
        $data->update(['weight' => $input['weight']]);
        $percent->update($inputPercent);
        return Redirect::action('WarehouseController@getStatistic', $data->warehouse_id);
    }

    public function search()
    {
        $input = Input::all();
        // dd($input);
        $departmentId = $input['department_id'];
        $deparment = Company::find($departmentId);
        $dataSearch = getChild($deparment);
        // dd($dataSearch);
        // $data = $this->model->orderBy('id', 'asc')->with('department')->paginate(10);
        $data = Warehouse::whereIn('department_id', $dataSearch)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return View::make('admin.warehouse.index')->with(compact('data'));
    }
    public function getCancelSearch()
    {
        return Redirect::action('WarehouseController@index');
    }

}
