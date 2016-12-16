<?php

class BaseCategoryController extends AdminController {
    protected $model;
    protected $view;

        const ZERO       = 0;
    const ONE        = 1;
    const NAME       = 'name';
    // const CRETED_BY       = 'created_by';
    // const UPDATED_BY      = 'updated_by';
    const DELETED         = 'deleted';

    function __construct(){
        $this->model = $this->getModuleName();
        $this->view = $this->getViewName();
    }

    /**
    * return module name. use for check permission.
    *
    * @return array
    */
    abstract protected function getModuleName();

    /**
    * return field before validator and store.
    *
    * @return array
    */
    abstract protected function getInputFieldStore();

    /**
    * return field before validator and update.
    *
    * @return array
    */
    abstract protected function getInputFieldUpdate();

    /**
    * return field before update.
    * @param model
    * @return model
    */
    abstract protected function updateData($model);

    /**
    * check field exit update.
    *
    * @return boolean.
    */
    abstract protected function relationFieldUpdateExit();

    /**
    * check field exit delete.
    * @param this collection $model.
    * @return boolean.
    */
    abstract protected function relationFieldDeleteExit($model);


    /**
    * return sub table result.
    * @param collection.
    * @return array
    */
    abstract protected function getSubTable($input);

    /**
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    abstract protected function validator(array $array);

     /**
    * [validator validator]
    * @param  this controller name
    * @return
    */
    protected function getViewName()
    {
        $controller = Route::currentRouteAction();
        die($controller);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->paginate(PAGINATE);
        return View::make($this->view)->with(compact('data'));
    }
    // public function index(){
    //     $permission = $this->auth->permission($this->moduleName, self::PERMISSION_READ);
    //     // check premission of user.
    //     if(!$permission){
    //         return $this->response->json(false,'','MESSAGE.PERMISSION_DENIED');
    //     }
    //     $result = $this->getDataBySomeModel($this->model);
    //     // sub table.
    //     $result = $this->getSubTable($result);

    //     return $this->response->json(true, $result, '');
    // }


  /**
   * [store store new model to db]
   * @return [object] [$model]
   */
    public function store(){
        try{
            $permission = $this->auth->permission($this->moduleName, self::PERMISSION_STORE);
            // check premission of user.
            if(!$permission){
                return $this->response->json(false,'','MESSAGE.PERMISSION_DENIED');
            }
            $data = $this->getInputFieldStore();
            $validator = $this->validator($data);
            if($validator->fails()){
                return $this->response->json(false,'','MESSAGE.VALIDATOR_FAILS');
            }

            $data[self::CRETED_BY]  = $this->auth->user()->id;
            $data[self::COMPANY_ID] = $this->company_id;

            $result = $this->model->create($data);
        }
        catch(\Exception $e){
            return $this->response->json(false, '', $this->getErrorMessages($e));
        }

        return $this->response->json(true, $result, 'MESSAGE.CREATE_SUCCESS');
    }

  /**
   * [update update once model]
   * @param  [int] $id [id of model need update]
   * @return [object]     [$model]
   */
    public function update($id){
        try{
            $permission = $this->auth->permission($this->moduleName, self::PERMISSION_UPDATE);
            // check premission of user.
            if(!$permission){
                return $this->response->json(false,'','MESSAGE.PERMISSION_DENIED');
            }

            $data = $this->getInputFieldUpdate();
            $data = array_filter($data);
            $validator = $this->validator($data);
            if($validator->fails()){
                return $this->response->json(false, '', 'MESSAGE.VALIDATOR_FAILS');
            }
            // this id relation exit.
            $result = $this->relationFieldUpdateExit();
            if(!$result){
                return $this->response->json(false, '', 'MESSAGE.RELATION_FIELD_SOMTHING_WENT_WRONG');
            }
            // this id exit.
            $model = $this->FindDataBySomeModel($this->model, $id);
            if($model==NULL){
                return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
            }
            $model->name = $data[self::NAME];
            $model->updated_by = $this->auth->user()->id;
            $model = $this->updateData($model);
            $model->save();

        }catch(\Exception $e ){
            return $this->response->json(false,'',$this->getErrorMessages($e));
        }

        return $this->response->json(true,  $model, 'MESSAGE.UPDATE_SUCCESS');
    }

  /**
   * [destroy set model status is deleted]
   * @param  [int] $id [id of model need set status is deleted]
   * @return [status]     [true or false]
   */
    public function destroy( $id){
        try {
            $permission = $this->auth->permission($this->moduleName, self::PERMISSION_DELETED);
            // check premission of user.
            if(!$permission){
                return $this->response->json(false,'','MESSAGE.PERMISSION_DENIED');
            }
            // check model exit.
            $model = $this->FindDataBySomeModel($this->model, $id);

            if(!$model){
                return $this->response->json(false,'','MESSAGE.RECORD_NOT_FOUND');
            }
            // relation field exit.
            $relationField = $this->relationFieldDeleteExit($model);
            if(!$relationField){
                return $this->response->json(false, '','MESSAGE.RELATION_FIELD_IS_NOT_NULL');
            }

            $model->deleted = 1;
            $model->save();
        } catch (Exception $e) {
            return $this->response->json(false,'',$this->getErrorMessages($e));
        }

        return $this->response->json(true,'','MESSAGE.DELETE_SUCCESS');
    }










    public function search()
    {
        $input = Input::all();
        if (!$input['keyword'] && !$input['role_id'] && $input['start_date'] && $input['end_date']) {
            return Redirect::action('ManagerController@index');
        }
        $data = AdminManager::searchUserOperation($input);
        return View::make('admin.manager.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.manager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'username'   => 'required|unique:admins,deleted_at,NULL|unique_delete',
            'password'   => 'required',
            'email'      => 'required|email|unique:admins,deleted_at,NULL|unique_delete',
            'role_id'    => 'required',
        );
        $input = Input::except('_token');
        $validator = Validator::make($input,$rules);
        if($validator->fails()) {
            return Redirect::action('ManagerController@create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $input['password'] = Hash::make($input['password']);
            $id = Admin::create($input)->id;
            if($id) {
                return Redirect::action('ManagerController@index');
            } else {
                dd('Error');
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $currentUserId = Auth::admin()->get()->id;
        $currentRoleId = Auth::admin()->get()->role_id;
        if($currentRoleId <> ADMIN) {
            if($id <> $currentUserId) {
                dd('error permission');
            }
        }

        $data = Admin::find($id);
        return View::make('admin.manager.edit', array('data'=>$data));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array();
        $rules = array(
            'username'   => 'required',
            // 'password'   => 'required',
            'email'      => 'required|email',
            'role_id'    => 'required',
        );
        if (!Admin::isAdmin()) {
            unset($rules['role_id']);
        }
        $input = Input::except('_token');

        $validator = Validator::make($input,$rules);
        if($validator->fails()) {
            return Redirect::action('ManagerController@edit', $id)
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            if($input['password'] != '') {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input['password'] = Auth::admin()->get()->password;
            }
            CommonNormal::update($id, $input);
            $currentUserId = Auth::admin()->get()->id;
            $currentRoleId = Auth::admin()->get()->role_id;
            if($currentRoleId <> ADMIN) {
                return Redirect::action('ManagerController@edit', $id);
            }
            return Redirect::action('ManagerController@index');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        CommonNormal::delete($id);
        return Redirect::action('ManagerController@index');
    }

    public function changePassword($id){
        $currentUserId = Auth::admin()->get()->id;
        $currentRoleId = Auth::admin()->get()->role_id;
        if($currentRoleId <> ADMIN) {
            if($id <> $currentUserId) {
                dd('error permission');
            }
        }

        $data = Admin::find($id);
        return View::make('admin.manager.changepassword')->with(compact('data'));
    }

    public function updatePassword($id){
        $rules = array(
            'password'   => 'required',
            'repassword' => 'required|same:password'
        );
        $input = Input::except('_token');
        $validator = Validator::make($input,$rules);
        if($validator->fails()) {
            return Redirect::action('ManagerController@changePassword',$id)
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
                $inputPass['password'] = Hash::make($input['password']);
                CommonNormal::update($id, $inputPass);
        }
        return Redirect::action('ManagerController@changePassword', $id)->with('message', 'Đổi mật khẩu thành công!');
    }

}
