<?php

class ProductManagerController extends AdminController {


    protected $model;


    const ZERO       = 0;
    const ONE        = 1;
    // field of branch table.
    const ID              = 'id';
    const NAME            = 'name';
    const CREATED_BY      = 'created_by';
    const UPDATED_BY      = 'created_by';
    const DELETED         = 'deleted';
    const MODULE_ID     = 'module_id';
    const CONTROLLER_ACTION      = 'controller_action';
    const ACTION   = 'action';
    function __construct(){
        $this->beforeFilter('checkPermission', array('except'=>array('login','doLogin','logout')));
    }
    public function create()
    {
        $listProduct = Product::all();
        $listProductCategory = ProductCategory::all();
        return View::make('admin.product-manage.create')->with(compact('listProduct', 'listProductCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::except('_token');
        if (isset($input['product'])) {
            foreach ($input['product'] as $productId => $value) {
                if ($value) {
                    $data[$productId] = array();
                    $data[$productId]['product_id'] = $productId;
                    $data[$productId]['product_category_id'] = $input['product_category_id'];
                    $data[$productId]['ratio'] = ($input['ratio'][$productId] != '') ? $input['ratio'][$productId] : 0 ;
                }
            }
            ProductManage::insert($data);
            // $inputPrimaryKey = ['product_id' => $input['product_id']];
            // $inputSave = ['product_category_id' => array_keys($input['product_category'])];
            // Common::saveOneToMany('ProductManage', $inputPrimaryKey, $inputSave);
        }
        return Redirect::action('ProductManagerController@index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $listProduct = Product::lists('name', 'id');
        $listProductCategory = ProductCategory::all();
        $data = [];
        foreach ($listProductCategory as $key => $value) {
            $data[$key] = new stdClass();
            $data[$key] = $value;
            $data[$key]->products = ProductManage::where('product_category_id', $value->id)->lists('product_id', 'ratio');
        }
        return View::make('admin.product-manage.index')->with(compact('data', 'listProduct'));
    }

    public function edit($id)
    {
        $data = ProductCategory::find($id);
        $listProduct = Product::lists('name', 'id');
        $manageProduct = ProductManage::where('product_category_id', $id)->get();
        return View::make('admin.product-manage.edit')->with(compact('data', 'listProduct', 'manageProduct'));
    }

    public function destroy($id)
    {
        ProductManage::where('product_id', $id)->delete();
        return Redirect::action('ProductManagerController@index');
    }

    public function update($id)
    {
        $input = Input::except('_token');
        ProductManage::where('product_category_id', $id)->delete();
        foreach ($input['product'] as $key => $value) {
            ProductManage::create([
                'product_category_id' => $id,
                'product_id' => $value,
                'ratio' => $input['ratio'][$key],
            ]);
        }
        return Redirect::action('ProductManagerController@index');
    }

    /*public function update($id)
    {
        $input = Input::except('_token');
        ProductManage::where('product_id', $id)->delete();
        if (isset($input['product'])) {
            $inputPrimaryKey = ['product_id' => $id];
            $inputSave = ['product_category_id' => array_keys($input['product'])];
            Common::saveOneToMany('ProductManage', $inputPrimaryKey, $inputSave);
        }
        return Redirect::action('ProductManagerController@index');
    }*/
    
}
