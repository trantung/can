<?php

class BranchCategoryController extends BaseCategoryController {
{

    protected $request;

    protected $branch;

    protected $model;

    protected $department;

    protected $auth;

    protected $response;

    protected $company_id;
    protected $moduleName;

    const ZERO       = 0;
    const ONE        = 1;
    // field of branch table.
    const ID              = 'id';
    const NAME            = 'name';
    const CRETED_BY       = 'created_by';
    const UPDATED_BY      = 'updated_by';
    const DELETED         = 'deleted';
    const COMPANY_ID      = 'company_id';

    const DEPARTMENT_ID   = 'department_id';
    const BRANCH_ID       = 'branch_id';

    const PERMISSION_STORE    = 'create';
    const PERMISSION_READ     = 'read';
    const PERMISSION_DELETED  = 'delete';
    const PERMISSION_UPDATE   = 'edit';
    const MODULE_NAME         = 'SYSTEMS';

  function __construct(Branch $branch,AuthService $auth,ResponseService $response,Request $request, Department $department)
  {
    $this->model = $branch;
    $this->department = $department;
    $this->branch = $branch;
    $this->auth = $auth;
    $this->response = $response;
    $this->request = $request;
    $this->company_id = $this->auth->user()->company_id;
    $this->moduleName = $this->getModuleName();
  }


    /**
    * return module name. use for check permission.
    *
    * @return array
    */
    protected function getModuleName()
    {
        return self::MODULE_NAME;
    }

    /**
    * return field before validator and store.
    *
    * @return array
    */
    protected function getInputFieldStore(){
        return $this->request->only(self::NAME);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return $this->request->only(self::NAME);
    }

    /**
    * return field before update.
    * @param model
    * @return model
    */
    protected function updateData($model){
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
        // get departments of branch.
        $departments    = $this->department->where(self::COMPANY_ID, $this->company_id)
                                           ->where(self::BRANCH_ID, $model->id)
                                           ->where(self::DELETED, self::ZERO)->get();
        if ($departments->isEmpty()) {
            return false;
        }
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
    protected function validator(array $array){
        return Validator::make($array,[
            self::NAME => 'required',
        ]);
    }

    /**
   * [destroy set branch status is deleted]
   * @param  [int] $id [id of branch need set status is deleted]
   * @return [status]     [true or false]
   */
    public function destroyBranchAndDepartment($id){
        try {
            DB::beginTransaction();
            $permission = $this->auth->permission(self::MODULE_NAME, self::PERMISSION_DELETED);
            // check premission of user.
            if(!$permission){
                return $this->response->json(false,'','MESSAGE.PERMISSION_DENIED');
            }
            // check branch exit.
            $branch = $this->FindDataBySomeModel($this->branch, $id);
            if(!$branch){
                return $this->response->json(false,'','MESSAGE.RECORD_NOT_FOUND');
            }

            // delete array relation department id .
            $this->department->where(self::COMPANY_ID, $this->company_id)
                             ->where(self::BRANCH_ID, $branch->id)
                             ->where(self::DELETED, self::ZERO)
                             ->update([self::DELETED => self::ONE]);
            // delete this branch.
            $branch->deleted = self::ONE;
            $branch->save();
        } catch (Exception $e) {
            DB::rollback();

            return $this->response->json(false,'',$this->getErrorMessages($e));
        }
        DB::commit();

        return $this->response->json(true, $id, 'MESSAGE.DELETE_SUCCESS');
    }


}
<?php namespace App\Repositories\Systems;

use App\Models\Systems\Branch;
use App\Models\Systems\Department;
use App\Services\AuthService;
use App\Services\ResponseService;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Repositories\Systems\SystemBaseRepository;

class BranchRepository extends SystemBaseRepository
{

    protected $request;

    protected $branch;

    protected $model;

    protected $department;

    protected $auth;

    protected $response;

    protected $company_id;
    protected $moduleName;

    const ZERO       = 0;
    const ONE        = 1;
    // field of branch table.
    const ID              = 'id';
    const NAME            = 'name';
    const CRETED_BY       = 'created_by';
    const UPDATED_BY      = 'updated_by';
    const DELETED         = 'deleted';
    const COMPANY_ID      = 'company_id';

    const DEPARTMENT_ID   = 'department_id';
    const BRANCH_ID       = 'branch_id';

    const PERMISSION_STORE    = 'create';
    const PERMISSION_READ     = 'read';
    const PERMISSION_DELETED  = 'delete';
    const PERMISSION_UPDATE   = 'edit';
    const MODULE_NAME         = 'SYSTEMS';

  function __construct(Branch $branch,AuthService $auth,ResponseService $response,Request $request, Department $department)
  {
    $this->model = $branch;
    $this->department = $department;
    $this->branch = $branch;
    $this->auth = $auth;
    $this->response = $response;
    $this->request = $request;
    $this->company_id = $this->auth->user()->company_id;
    $this->moduleName = $this->getModuleName();
  }


    /**
    * return module name. use for check permission.
    *
    * @return array
    */
    protected function getModuleName()
    {
        return self::MODULE_NAME;
    }

    /**
    * return field before validator and store.
    *
    * @return array
    */
    protected function getInputFieldStore(){
        return $this->request->only(self::NAME);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return $this->request->only(self::NAME);
    }

    /**
    * return field before update.
    * @param model
    * @return model
    */
    protected function updateData($model){
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
        // get departments of branch.
        $departments    = $this->department->where(self::COMPANY_ID, $this->company_id)
                                           ->where(self::BRANCH_ID, $model->id)
                                           ->where(self::DELETED, self::ZERO)->get();
        if ($departments->isEmpty()) {
            return false;
        }
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
    protected function validator(array $array){
        return Validator::make($array,[
            self::NAME => 'required',
        ]);
    }

    /**
   * [destroy set branch status is deleted]
   * @param  [int] $id [id of branch need set status is deleted]
   * @return [status]     [true or false]
   */
    public function destroyBranchAndDepartment($id){
        try {
            DB::beginTransaction();
            $permission = $this->auth->permission(self::MODULE_NAME, self::PERMISSION_DELETED);
            // check premission of user.
            if(!$permission){
                return $this->response->json(false,'','MESSAGE.PERMISSION_DENIED');
            }
            // check branch exit.
            $branch = $this->FindDataBySomeModel($this->branch, $id);
            if(!$branch){
                return $this->response->json(false,'','MESSAGE.RECORD_NOT_FOUND');
            }

            // delete array relation department id .
            $this->department->where(self::COMPANY_ID, $this->company_id)
                             ->where(self::BRANCH_ID, $branch->id)
                             ->where(self::DELETED, self::ZERO)
                             ->update([self::DELETED => self::ONE]);
            // delete this branch.
            $branch->deleted = self::ONE;
            $branch->save();
        } catch (Exception $e) {
            DB::rollback();

            return $this->response->json(false,'',$this->getErrorMessages($e));
        }
        DB::commit();

        return $this->response->json(true, $id, 'MESSAGE.DELETE_SUCCESS');
    }


}
