<?php

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
    
    public function getLogScale()
    {
        $input = Input::except('page');
        $model = new ScaleKCS();
        $input = self::processData($input);
        if (count($input) > 0) {
            $model = $model->where($input);
        }
        $data = $model->orderBy('id', 'desc')->paginate(PAGINATE);
        return View::make('admin.scale-station.log-scale')->with(compact('data'));
    }

    public function getLogKcs()
    {
        $data = ScaleKCS::where('type', 'KCS')->paginate(PAGINATE);
        return View::make('admin.scale-station.log-kcs')->with(compact('data'));
    }

    public function destroy($id)
    {
        $scale = ScaleStation::find($id);
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

    function processData($input = array())
    {
        if (count($input) > 0) {
            foreach ($input as $key => $value) {
                if ($value == '') {
                    unset($input[$key]);
                }
            }
        }
        return $input;
    }
}
