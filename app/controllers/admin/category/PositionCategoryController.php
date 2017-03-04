<?php

class PositionCategoryController extends BaseCategoryController {


    protected $model;


    const ZERO       = 0;
    const ONE        = 1;
    // field of branch table.
    const ID              = 'id';
    const NAME            = 'name';
    const CREATED_BY      = 'created_by';
    const UPDATED_BY      = 'created_by';
    const DELETED         = 'deleted';
    const DESCRIPTION     = 'description';
    const COMPANY_ID      = 'company_id';

    const DEPARTMENT_ID   = 'department_id';
    const OFICER_ID       = 'oficer_id';
    const BRANCH_ID       = 'branch_category_id';




    /**
    * return module name. use for check permission.
    *
    * @return array
    */
    protected function getModel()
    {
        return new Position;
    }

    /**
    * return field before validator and store.
    *
    * @return array
    */
    protected function getInputFieldStore(){
        return Input::only(self::NAME, self::DESCRIPTION);
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
    * return field before update.
    * @param collection.
    * @return model
    */
    protected function getSubTable(){
        // if (debug_backtrace()[1]['function'] == 'index') {
            return $this->buildArrayData( Company::orderBy('id', 'asc')->get());
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
        return Redirect::action('PositionCategoryController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.system.position.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.system.position.create';
    }
    protected function viewOfActionShow(){
        return 'admin.system.position.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.system.position.edit';
    }
    public function getPositionWithBranch()
    {
        $partern = Input::only(self::BRANCH_ID);
        return $this->buildArrayData(Position::where($partern)->get());
    }
}
