<?php

use Carbon\Carbon;

class ProductionAutoController extends BaseCategoryController {


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
        return new ProductionAuto;
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
        return Redirect::action('ProductionAutoController@index');
    }


    protected function viewOfActionIndex(){
        return 'admin.production-auto.index';
    }
    protected function viewOfActionCreate(){
        return 'admin.production-auto.create';
    }
    protected function viewOfActionShow(){
        return 'admin.production-auto.detail';
    }
    protected function viewOfActionEdit(){
        return 'admin.production-auto.edit';
    }

    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->paginate(10);
        return View::make($this->viewOfActionIndex(), ['data'=>$data]);
    }

    public function getNumberCoupon() {
        $result = str_pad(12, 8, "0", STR_PAD_LEFT);
        $now = Carbon::now();
        $coupon = $now->second . $now->minute . $now->hour . $now->day . $now->month . $now->year;
        dd($result);
    }

    public function store()
    {
        $input = Input::except('_token');
        dd($input);
        $productCategoryWeight = $input['product_category_weight'];
        // $weightStorage = calculatorProductAuto($input['product_category_id'], $input['product_id'], $input['product_category_weight'], $input['warehouse_id']);
        return View::make('admin.production-auto.show')->with(compact('weightStorage', 'input'));
        dd($input);
    }

}