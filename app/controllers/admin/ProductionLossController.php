<?php

class ProductionLossController extends BaseCategoryController {


    protected $model;


    const ZERO       = 0;
    const ONE        = 1;
    // field of contract table.
    const ID              = 'id';
    const NUMBER            = 'number';
    const CRETED_BY       = 'created_by';
    const UPDATED_BY      = 'created_by';
    const DELETED         = 'deleted';
    const STATUS     = 'status';


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
        return new ProductionLoss;
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
        return Input::only(self::NUMBER);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(self::NUMBER);
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
            self::NUMBER => 'required',
        ]);
    }

    /**
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    protected function updateValidater(array $array){
        return Validator::make($array,[
            self::NUMBER => 'required',
        ]);
    }

    protected function redirectBackAction(){
        return Redirect::action('ProductionLossController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.production-loss.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.production-loss.create';
    }
    protected function viewOfActionShow(){
        return 'admin.production-loss.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.production-loss.edit';
    }

    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->paginate(10);
        return View::make($this->viewOfActionIndex(), ['data'=>$data]);
    }

}
