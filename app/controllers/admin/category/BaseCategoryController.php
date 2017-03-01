<?php

abstract class BaseCategoryController extends AdminController {
    protected $model;
    protected $view;

    const ZERO       = 0;
    const ONE        = 1;
    const ID         = 'id';
    const NAME       = 'name';
    const CREATED_BY      = 'created_by';
    const UPDATED_BY      = 'updated_by';
    const DELETED         = 'deleted';

    function __construct(){
        parent::__construct();
        $this->model = $this->getModel();
    }
    /**
    * return module name. use for check permission.
    *
    * @return array
    */
    abstract protected function getModel();

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
    abstract protected function updateMoreData($model);

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
    * @return array
    */
    abstract protected function getSubTable();

    /**
    * [validator validator]
    * @param  array  $array [all input need validate]
    * @return
    */
    abstract protected function storeValidater(array $array);
    abstract protected function updateValidater(array $array);

    /**
    * return redirect back action
    */
    abstract protected function redirectBackAction();

     /**
    * [validator validator]
    * @param  this controller name
    * @return
    */
    abstract protected function viewOfActionIndex();
    abstract protected function viewOfActionCreate();
    abstract protected function viewOfActionEdit();
    abstract protected function viewOfActionShow();


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->paginate(10);
        $subTable = $this->getSubTable();
        return View::make($this->viewOfActionIndex(), ['data'=>$data, 'subTable'=>$subTable]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $subTable = $this->getSubTable();
        return View::make($this->viewOfActionCreate(), ['subTable'=>$subTable]);
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
            $id = $this->model->create($input)->id;
            if(!$id) {
                dd('Error');
            }
        } catch(Exception $e){
            return $this->returnError($e);
        }

        return $this->redirectBackAction();
    }

    public function edit($id)
    {
        $data = $this->model->find($id);
        $subTable = $this->getSubTable();
        // dd()

        return View::make($this->viewOfActionEdit(), ['data'=>$data, 'subTable'=>$subTable] );
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
            // dd($input);
            $result = $this->model->where(self::ID, $id)->update($input);
            if(!$result) {
                dd('Error');
            }
        } catch(Exception $e){
            return $this->returnError($e);
        }

        return $this->redirectBackAction();
    }

  /**
   * [destroy set model status is deleted]
   * @param  [int] $id [id of model need set status is deleted]
   * @return [status]     [true or false]
   */
    public function destroy( $id){
        try {
            $result = $this->model->where(self::ID, $id)->delete();
            if(!$result) {
                dd('Error');
            }
        } catch(Exception $e){
            return $this->returnError($e);
        }

        return $this->redirectBackAction();
    }

}
