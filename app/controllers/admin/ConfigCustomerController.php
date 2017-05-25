<?php

class ConfigCustomerController extends AdminController {


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

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::except('_token');
        if (isset($input['personal'])) {
            $inputPrimaryKey = ['customer_group_id' => $input['customer_group_id']];
            $inputSave = ['customer_id' => array_keys($input['personal'])];
            Common::saveOneToMany('CustomerManage', $inputPrimaryKey, $inputSave);
        }
        return Redirect::action('ConfigCustomerController@index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $listUser = CustomerGroup::all();
        $listPersonal = CustomerShip::lists('customer_name', 'id');
        $data = [];
        foreach ($listUser as $key => $value) {
            $data[$key] = new stdClass();
            $data[$key] = $value;
            $data[$key]->customers = CustomerManage::where('customer_group_id', $value->id)->lists('customer_id');
        }
        return View::make('admin.customer-group.config.index')->with(compact('data', 'listPersonal'));
    }

    public function edit($id)
    {
        $data = CustomerGroup::find($id);
        $listPersonal = CustomerShip::all();
        return View::make('admin.customer-group.config.edit')->with(compact('data', 'listPersonal'));
    }

    public function destroy($id)
    {
        CustomerManage::where('customer_group_id', $id)->delete();
        return Redirect::action('ConfigCustomerController@index');
    }

    public function update($id)
    {
        $input = Input::except('_token');
        CustomerManage::where('customer_group_id', $id)->delete();
        if (isset($input['list_customer'])) {
            $inputPrimaryKey = ['customer_group_id' => $id];
            $inputSave = ['customer_id' => array_keys($input['list_customer'])];
            Common::saveOneToMany('CustomerManage', $inputPrimaryKey, $inputSave);
        }
        return Redirect::action('ConfigCustomerController@index');

    }
    
}
