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
        $this->beforeFilter('checkPermission', array('except'=>array('login','doLogin','logout')));
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
        //tru khoi luong nguyen lieu(product category) o kho warehouse_id,
        $categoryProduct = StorageLoss::where('model_name', 'ProductCategory')
            ->where('model_id', $input['product_category_id'])
            ->where('warehouse_id', $input['warehouse_id'])
            ->first();
        if (!$categoryProduct) {
            dd('sai kho');
        }
        $categoryProductWeight = $categoryProduct->weight;
        if (!$categoryProductWeight) {
            dd('sai khoi luong');
        }
        $categoryProduct->update([
            'weight' => $categoryProductWeight - $input['product_category_weight']
        ]);
        //cong them khoi luong thanh pham(product) vao kho warehouse_output_id
        $product = StorageLoss::where('model_name', 'Product')
            ->where('model_id', $input['product_id'])
            ->where('warehouse_id', $input['warehouse_output_id'])
            ->first();
        //neu chua co thi tao moi 
        if (!$product) {
            $product = StorageLoss::create([
                'model_id' => $input['model_id'],
                'model_name' => 'Product',
                'warehouse_id' => $input['warehouse_output_id'],
                'model_id' => $input['model_id'],
                'weight' => $input['product_weight'],
            ]);
        }
        //neu da co san pham thi cong them khoi luong product vao
        else {
            $product->update([
                'weight' => $product->weight + $input['product_weight']
            ]);
        }
        //tao moi tu san xuat
        $productAuto['code'] = $input['production-loss-department_id'];
        $productAuto['department_id'] = $input['department_id'];
        $productAuto['warehouse_id'] = $input['warehouse_id'];
        $productAuto['product_category_id'] = $input['product_category_id'];
        $productAuto['product_id'] = $input['product_id'];
        $productAuto['storage_loss_id'] = $input['storage_loss_id'];
        $productAuto['product_loss_id'] = $input['product_loss_id'];
        $productAuto['product_category_weight'] = $input['product_category_weight'];
        $productAuto['product_weight'] = $input['product_weight'];
        $productAuto['warehouse_output_id'] = $input['warehouse_output_id'];
        $productAuto['product_weight'] = $input['product_weight'];
        $productAuto['department_output_id'] = $input['department_id'];
        $productAuto['storage_weight'] = $product->weight;
        ProductionAuto::create($productAuto);
        return $this->redirectBackAction();
        // $weightStorage = calculatorProductAuto($input['product_category_id'], $input['product_id'], $input['product_category_weight'], $input['warehouse_id']);
        // return View::make('admin.production-auto.show')->with(compact('weightStorage', 'input'));
        // dd($input);
    }

}
