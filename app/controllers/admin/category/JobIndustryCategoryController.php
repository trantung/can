<?php

class JobIndustryCategoryController extends BaseCategoryController {


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




    /**
    * return module name. use for check permission.
    *
    * @return array
    */
    protected function getModel()
    {
        return new JobIndustryCategory;
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
        return Input::only(self::NAME);
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
        return NULL;
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
        return Redirect::action('JobIndustryCategoryController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.system.job-industry.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.system.job-industry.create';
    }
    protected function viewOfActionShow(){
        return 'admin.system.job-industry.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.system.job-industry.edit';
    }

}
