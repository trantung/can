<?php

class CustomerGroupController extends BaseCategoryController {


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
        return new CustomerGroup;
    }

    /**
    * return field before validator and store.
    *
    * @return array
    */
    protected function getInputFieldStore(){
        return Input::only(
            self::NAME
        );
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(
            self::NAME
        );
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
        return [];
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
        return Redirect::action('CustomerGroupController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.customer-group.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.customer-group.create';
    }
    protected function viewOfActionShow(){
        return 'admin.customer-group.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.customer-group.edit';
    }

    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->paginate(10);
        $subTable = $this->getSubTable();
        return View::make($this->viewOfActionIndex(), ['data'=>$data, 'subTable'=>$subTable]);
    }

}
