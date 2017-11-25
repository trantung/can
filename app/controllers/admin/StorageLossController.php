<?php

class StorageLossController extends BaseCategoryController {


    protected $model;


    const ZERO       = 0;
    const ONE        = 1;
    // field of contract table.
    const ID              = 'id';
    const RATIO          = 'ratio';
    const WAREHOUSE_ID      = 'warehouse_id';
    const MODEL_NAME      = 'model_name';
    const MODEL_ID        = 'model_id';
    const CRETED_BY       = 'created_by';
    const UPDATED_BY      = 'created_by';
    const DELETED         = 'deleted';
    const STATUS     = 'status';


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
        return new StorageLoss;
    }

    /**
    * return field before update.
    * @param collection.
    * @return model
    */
    protected function getSubTable(){
        return [];
    }

    /**
    * return field before validator and store.
    *
    * @return array
    */
    protected function getInputFieldStore(){
        return Input::only(self::NAME, self::RATIO, self::MODEL_ID, self::MODEL_NAME, self::WAREHOUSE_ID);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(self::NAME, self::RATIO, self::MODEL_ID, self::MODEL_NAME, self::WAREHOUSE_ID);
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
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    protected function storeValidater(array $array){
        return Validator::make($array,[
            self::MODEL_NAME => 'required',
        ]);
    }

    /**
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    protected function updateValidater(array $array){
        return Validator::make($array,[
            // self::MODEL_NAME => 'required',
        ]);
    }

    protected function redirectBackAction(){
        return Redirect::action('StorageLossController@index');
    }


    public function viewOfActionIndex(){
        return 'admin.storage-loss.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.storage-loss.create';
    }
    protected function viewOfActionShow(){
        return 'admin.storage-loss.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.storage-loss.edit';
    }
    public function update($id) 
    {
        $input = Input::except('_token', '_method');
        foreach ($input['ratio'] as $key => $value) {
            $storage = StorageLoss::find($key);
            if ($storage) {
                $storage->update(['ratio' => $value]);
            }
        }
        return Redirect::action('StorageLossController@index');
    }
    public function index()
    {
        $data = Warehouse::orderBy('id', 'asc')->paginate(10);
        // $data = $this->model->orderBy('id', 'asc')->paginate(10);
        return View::make($this->viewOfActionIndex(), ['data'=>$data]);
    }
    public function reset($id)
    {
        $data = StorageLoss::where('warehouse_id', $id)->update(['ratio' => 0]);
        return Redirect::action('StorageLossController@index');
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
        // dd($data);
        return View::make('admin.storage-loss.index')->with(compact('data'));
    }
    public function cancelSearch()
    {
        return Redirect::action('StorageLossController@index');
    }

}
