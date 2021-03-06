<?php

class CompanyCategoryController extends BaseCategoryController {


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
    const LEVEL           = 'level';
    const SLUG            = 'slug';
    const PARENTS         = 'parents';
    const PARENT_ID         = 'parent_id';
    const CODE         = 'code';
    const PHONE         = 'phone';
    const FAX         = 'fax';
    const EMAIL         = 'email';





    /**
    * return module name. use for check permission.
    *
    * @return array
    */
    protected function getModel()
    {
        return new Company;
    }

    /**
    * return field before validator and store.
    *
    * @return array
    */
    protected function getInputFieldStore(){
        return Input::only(self::NAME, self::DESCRIPTION, self::PARENT_ID,
            self::FAX, self::PHONE, self::EMAIL,
            self::LEVEL, self::CODE);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(self::NAME, self::DESCRIPTION, self::PARENT_ID,
            self::FAX, self::PHONE, self::EMAIL,
            self::LEVEL, self::CODE);
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
        $level = Input::only('type');
        if ($level) {
            $level = 'tap-doan';
        }
        $category =  CompanyCategoryLevel::get();
        // dd($category->toArray());
        $type = CompanyCategoryLevel::where(self::SLUG, $level)->first();
        $result = $this->model->get();
        return [
            'select'=> $this->buildArrayData($category),
            'typeName'=>$type->name,
            'companyName' => $this->buildArrayData($result),
        ];
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
        return Redirect::action('CompanyCategoryController@index',['type'=>Input::only('type')]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $level = Input::only('type');
        if ($level) {
            $level = 'tap-doan';
        }
        $type = CompanyCategoryLevel::where(self::SLUG, $level)->first();
        $data = $this->model->orderBy('id', 'asc')->get();
        // dd($data->toArray());
        $data = $this->buildTree($data->toArray());
        // $data = $this->buildCate(0);
        return View::make($this->viewOfActionIndex(), ['data'=>$data, 'typeName'=>$type->name]);
    }

    public function buildCateJsTree($parentId = 0) {
        $listData = $this->model->where('parent_id', $parentId)->orderBy('id', 'asc')->get();
        $data = array();
        if (!$listData->isEmpty()) {
            foreach ($listData as $key => $value) {
                $data[$key] = new \stdClass();
                $data[$key]->id = $value->id;
                $data[$key]->text = $value->name;
                $children = Self::buildCateJsTree($value->id);
                if (!empty($children)) {
                    $data[$key]->children = $children;
                }
            }
        }
        return $data;
    }

    public function buildCate($parentId = 0) {
        $listData = $this->model->where('parent_id', $parentId)->orderBy('id', 'asc')->get();
        $data = array();
        if (!$listData->isEmpty()) {
            foreach ($listData as $key => $value) {
                $data[$key] = new \stdClass();
                $data[$key] = $value;
                $children = Self::buildCate($value->id);
                if (!empty($children)) {
                    $data[$key]->children = $children;
                }
            }
        }
        return $data;
    }

    public function getDepartment() {
        $data = $this->model->get();
        return $data;
    }

      /**
   * [store store new model to db]
   * @return [object] [$model]
   */
    public function store(){
        try{
            $input = $this->getInputFieldStore();
            $validator = $this->storeValidater($input);
            $input[self::CREATED_BY] = Auth::admin()->get()->id;
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            if($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            if (! $input[self::PARENT_ID]) {
                $input[self::PARENT_ID] = 0;
                // $input[self::LEVEL] = $parents->level +1;
                // if ($input[self::LEVEL]>8) {
                //     dd('không thể chọn "'.$parents->name.'" làm parents cho '.$input[self::NAME]);
                // }
            }
            $id = $this->model->create($input)->id;
            if(!$id) {
                dd('Error');
            }
        } catch(Exception $e){
            return $this->returnError($e);
        }

        return $this->redirectBackAction();
    }

    public function show($id)
    {
        $data = $this->model->find($id);
        $subTable = $this->getSubTable();
        // dd($subTable);

        return View::make($this->viewOfActionShow(), ['data'=>$data, 'subTable'=>$subTable] );
    }

    /**
   * [update update once model]
   * @param  [int] $id [id of model need update]
   * @return [object]     [$model]
   */
    public function update($id){
        try{
            $listChild = $this->model->where(self::PARENT_ID, $id)->lists('id');
            $input = $this->getInputFieldUpdate();
            if (in_array($input['parent_id'], $listChild) ) {
                dd('Error');
            }
            $validator = $this->updateValidater($input);
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            if($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput($input);
            }
            $parent_node = $this->model->where(self::ID, $input[self::PARENT_ID])->first();
            if ($parent_node) {
                 if (intval($parent_node->id) === intval($id)) {
                    // return $this->redirectBackAction();
                   dd('Error');
                }
            }
           
            $result = $this->model->where(self::ID, $id)->update($input);
            if(!$result) {
                dd('Error');
            }
        } catch(Exception $e){
            return $this->returnError($e);
        }

        return $this->redirectBackAction();
    }

    protected function viewOfActionIndex(){
        return 'admin.system.company.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.system.company.create';
    }
    protected function viewOfActionShow(){
        return 'admin.system.company.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.system.company.edit';
    }


    //haind
    public function destroy($id)
    {
        try {
            if (PersonalInfo::where('company_id', $id)->exists()) {
                dd('Không thể xóa khi có nhân viên tại đơn vị này');
            }
            if ($this->model->where(self::PARENT_ID, $id)->exists()) {
                dd('Không thể xóa khi có cấp con');
            } else {
                $result = $this->model->find($id)->delete();
            }
            if(!$result) {
                dd('Error');
            }
        } catch(Exception $e){
            return $this->returnError($e);
        }
        $response['status'] = true;
        return Response::json($response);
        
    }

    public function getDepartmentByOne($id)
    {
        $current = $this->model->find($id);
        if (!$current) {
            dd('Chi nhánh hiện tại không có trong hệ thống');
        }
        $listDepartment = $this->model->level($current->level)->get();
        if (!$listDepartment) {
            dd('Không có chi nhánh nào cùng cấp bậc');
        }
        return Response::json($listDepartment);
    }

}
