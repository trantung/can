<?php

class BranchCategoryController extends BaseCategoryController {


    protected $model;


    const ZERO       = 0;
    const ONE        = 1;
    // field of branch table.
    const ID              = 'id';
    const NAME            = 'name';
    const CRETED_BY       = 'created_by';
    const UPDATED_BY      = 'created_by';
    const DELETED         = 'deleted';
    const DESCRIPTION     = 'description';
    const ADDRESS         = 'address';
    const COMPANY_ID      = 'company_id';

    const DEPARTMENT_ID   = 'department_id';
    const BRANCH_ID       = 'branch_id';




    /**
    * return module name. use for check permission.
    *
    * @return array
    */
    protected function getModel()
    {
        return new Branch;
    }

    /**
    * return field before validator and store.
    *
    * @return array
    */
    protected function getInputFieldStore(){
        return Input::only(self::NAME, self::ADDRESS, self::COMPANY_ID);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(self::NAME, self::ADDRESS, self::COMPANY_ID);
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
        return $this->buildArrayData( Company::select([self::NAME, self::ID])->orderBy('id', 'asc')->get() );
    }

    /**
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    protected function storeValidater(array $array){
        return Validator::make($array,[
            self::NAME => 'required',
            self::ADDRESS => 'required',
            self::COMPANY_ID => 'required|integer',
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
            self::ADDRESS => 'required',
            self::COMPANY_ID => 'required|integer',
        ]);
    }

    protected function redirectBackAction(){
        return Redirect::action('BranchCategoryController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.system.branch.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.system.branch.create';
    }
    protected function viewOfActionShow(){
        return 'admin.system.branch.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.system.branch.edit';
    }
}
