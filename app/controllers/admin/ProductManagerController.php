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
        if (isset($input['product_category'])) {
            $inputPrimaryKey = ['product_id' => $input['product_id']];
            $inputSave = ['product_category_id' => array_keys($input['product_category'])];
            Common::saveOneToMany('ProductManage', $inputPrimaryKey, $inputSave);
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
        $listProduct = Product::all();
        $listProductCategory = ProductCategory::lists('name', 'id');
        $data = [];
        foreach ($listProduct as $key => $value) {
            $data[$key] = new stdClass();
            $data[$key] = $value;
            $data[$key]->products = ProductManage::where('product_id', $value->id)->lists('product_category_id');
        }
        return View::make('admin.product-manage.index')->with(compact('data', 'listProductCategory'));
    }

    public function edit($id)
    {
        $data = Product::find($id);
        $listProductCategory = ProductCategory::all();
        return View::make('admin.product-manage.edit')->with(compact('data', 'listProductCategory'));
    }

    public function destroy($id)
    {
        ProductManage::where('product_id', $id)->delete();
        return Redirect::action('ProductManagerController@index');
    }

    public function update($id)
    {
        $input = Input::except('_token');
        ProductManage::where('product_id', $id)->delete();
        if (isset($input['product'])) {
            $inputPrimaryKey = ['product_id' => $id];
            $inputSave = ['product_category_id' => array_keys($input['product'])];
            Common::saveOneToMany('ProductManage', $inputPrimaryKey, $inputSave);
        }
        return Redirect::action('ProductManagerController@index');
    }
    
}
