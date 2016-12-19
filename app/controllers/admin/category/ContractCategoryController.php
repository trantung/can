<?php

class ContractCategoryController extends BaseCategoryController {


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
        return Input::only(self::NAME, self::ADDRESS);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(self::NAME, self::ADDRESS);
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
    protected function getSubTable($input){
        return $input->toArray();
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

    /**
   * [destroy set branch status is deleted]
   * @param  [int] $id [id of branch need set status is deleted]
   * @return [status]     [true or false]
   */
    public function destroyBranchAndDepartment($id){
        // try {
        //     DB::beginTransaction();
        //     $permission = $this->auth->permission(self::MODULE_NAME, self::PERMISSION_DELETED);
        //     // check premission of user.
        //     if(!$permission){
        //         return $this->response->json(false,'','MESSAGE.PERMISSION_DENIED');
        //     }
        //     // check branch exit.
        //     $branch = $this->FindDataBySomeModel($this->branch, $id);
        //     if(!$branch){
        //         return $this->response->json(false,'','MESSAGE.RECORD_NOT_FOUND');
        //     }

        //     // delete array relation department id .
        //     $this->department->where(self::COMPANY_ID, $this->company_id)
        //                      ->where(self::BRANCH_ID, $branch->id)
        //                      ->where(self::DELETED, self::ZERO)
        //                      ->update([self::DELETED => self::ONE]);
        //     // delete this branch.
        //     $branch->deleted = self::ONE;
        //     $branch->save();
        // } catch (Exception $e) {
        //     DB::rollback();

        //     return $this->response->json(false,'',$this->getErrorMessages($e));
        // }
        // DB::commit();

        // return $this->response->json(true, $id, 'MESSAGE.DELETE_SUCCESS');
    }

}
