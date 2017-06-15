<?php

class ConfigPropertyController extends BaseCategoryController {


    protected $model;


    const ZERO       = 0;
    const ONE        = 1;
    // field of contract table.
    const ID              = 'id';
    const NAME            = 'name';
    const CRETED_BY       = 'created_by';
    const UPDATED_BY      = 'created_by';
    const DELETED         = 'deleted';
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
        return new ConfigProperty;
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
        return Input::only(self::NAME);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(self::NAME, self::DESCRIPTION);
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
        return Redirect::action('ConfigPropertyController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.config-property.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.config-property.create';
    }
    protected function viewOfActionShow(){
        return 'admin.config-property.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.config-property.edit';
    }

    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->paginate(10);
        return View::make($this->viewOfActionIndex(), ['data'=>$data]);
    }
    public function store()
    {
        $input = Input::except('_token');
        $input['data'] = json_encode($input['data']);
        $id = $this->model->create($input)->id;
        return Redirect::action('ConfigPropertyController@index');
    }

    public function update($id){
        $input = Input::except('_token', '_method');
        $data = $this->model->find($id);
        $data->data = json_encode($input['data']);
        $data->save();
        return Redirect::action('ConfigPropertyController@index');
    }
}
