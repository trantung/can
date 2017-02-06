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
        return Input::only(self::NAME, self::DESCRIPTION, self::PARENT_ID, self::LEVEL, self::CODE);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(self::NAME, self::DESCRIPTION, self::PARENT_ID, self::LEVEL, self::CODE);
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
            'companyName' => $this->buildArrayData($result,1),
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
        // dd( $data);

        return View::make($this->viewOfActionIndex(), ['data'=>$data, 'typeName'=>$type->name]);
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
                return Redirect::back()->withErrors($validator)->withInput($input);
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

    /**
   * [update update once model]
   * @param  [int] $id [id of model need update]
   * @return [object]     [$model]
   */
    public function update($id){
        try{
            $input = $this->getInputFieldUpdate();
            $validator = $this->updateValidater($input);
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            if($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput($input);
            }
            $parent_node = $this->model->where(self::ID, $input[self::PARENT_ID])->first();
            // dd($parent_node->toArray());
            // $result = $this->model->where(self::ID, $id)->first();
            if ($parent_node->parent_id != $id) {
                $result = $this->model->where(self::ID, $id)->update($input);
                if(!$result) {
                    dd('Error');
                }
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

}
