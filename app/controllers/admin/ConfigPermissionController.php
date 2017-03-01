<?php

class ConfigPermissionController extends BaseCategoryController {


    protected $model;


    const ZERO       = 0;
    const ONE        = 1;
    // field of branch table.
    const ID              = 'id';
    const NAME            = 'name';
    const CREATED_BY      = 'created_by';
    const UPDATED_BY      = 'created_by';
    const DELETED         = 'deleted';
    const MODULE_ID     = 'module_id';
    const CONTROLLER_ACTION      = 'controller_action';
    const ACTION   = 'action';

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
        return new Permission;
    }

    /**
    * return field before validator and store.
    *
    * @return array
    */
    protected function getInputFieldStore(){
        return Input::only(self::NAME, self::MODULE_ID, self::CONTROLLER_ACTION, self::ACTION);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(self::NAME, self::MODULE_ID, self::CONTROLLER_ACTION, self::ACTION);
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
        // if (debug_backtrace()[1]['function'] == 'index') {
            return $this->buildArrayData( Module::orderBy('id', 'asc')->get());
        // }
        // return $this->buildArrayData( Company::orderBy('id', 'asc')->with('branchs')->get(),'branchs' );
    }

    /**
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    protected function storeValidater(array $array){
        return Validator::make($array,[
            self::NAME => 'required',
            self::MODULE_ID => 'required',
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
            self::MODULE_ID => 'required',
        ]);
    }

    protected function redirectBackAction(){
        return Redirect::action('ConfigPermissionController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.permission.config.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.permission.config.create';
    }
    protected function viewOfActionShow(){
        return 'admin.permission.config.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.permission.config.edit';
    }
    
}
