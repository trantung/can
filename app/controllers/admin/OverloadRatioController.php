<?php

class OverloadRatioController extends BaseCategoryController {


    protected $model;


    const ZERO       = 0;
    const ONE        = 1;
    // field of contract table.
    const ID              = 'id';
    const MODEL_NAME            = 'model_name';
    const CRETED_BY       = 'created_by';
    const UPDATED_BY      = 'created_by';
    const DELETED         = 'deleted';
    const MODEL_ID   = 'model_id';
    const DATA   = 'data';


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
        return new OverloadRatio;
    }

    /**
    * return field before validator and store.
    *
    * @return array
    */
    protected function getInputFieldStore(){
        return Input::only(self::MODEL_NAME, self::MODEL_ID, self::DATA);
    }

    /**
    * return field before validator and update.
    *
    * @return array
    */
    protected function getInputFieldUpdate(){
        return Input::only(self::MODEL_NAME, self::MODEL_ID, self::DATA);
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
        return [];
    }

    /**
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    protected function storeValidater(array $array){
        return Validator::make($array,[
            self::MODEL_NAME => 'required',
        ]);
    }

    /**
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    protected function updateValidater(array $array){
        return Validator::make($array,[
            self::MODEL_NAME => 'required',
        ]);
    }

    protected function redirectBackAction(){
        return Redirect::action('OverloadRatioController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.overload-ratio.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.overload-ratio.create';
    }
    protected function viewOfActionShow(){
        return 'admin.overload-ratio.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.overload-ratio.edit';
    }

    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->paginate(10);
        $subTable = $this->getSubTable();
        return View::make($this->viewOfActionIndex(), ['data'=>$data, 'subTable'=>$subTable]);
    }

    /**
   * [store store new model to db]
   * @return [object] [$model]
   */
    public function store(){
        try{
            $input = $this->getInputFieldStore();
            $validator = $this->storeValidater($input);
            $input['data'] = json_encode(array_combine(Input::get('key'),Input::get('value')));
            $input[self::CREATED_BY] = Auth::admin()->get()->id;
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            if($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput($input);
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

}
