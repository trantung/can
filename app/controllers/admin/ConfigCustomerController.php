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
    function __construct(){
        $this->beforeFilter('checkPermission', array('except'=>array('login','doLogin','logout')));
    }
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
        // dd(11);
        // $listUser = CustomerGroup::all();
        $data = CustomerShip::distinct('customer_id')->get();
        // dd(11);
        // $data = [];
        // foreach ($listUser as $key => $value) {
        //     $data[$key] = new stdClass();
        //     $data[$key] = $value;
        //     $data[$key]->customers = CustomerManage::where('customer_group_id', $value->id)->lists('customer_id');
        // }
        return View::make('admin.customer-group.config.index')->with(compact('data'));
    }

    public function edit($id)
    {
        $data = CustomerShip::find($id);
        // dd($data);
        $group = CustomerManage::where('customer_id', $id)->first();
        if ($group) {
            $customerGroup = $group->customer_group_id;
        } else {
            $customerGroup = null;
        }
        $listPersonal = CustomerGroup::lists('name', 'id');
        return View::make('admin.customer-group.config.edit')->with(compact('data', 'listPersonal', 'customerGroup'));
    }

    public function destroy($id)
    {
        CustomerManage::where('customer_id', $id)->delete();
        return Redirect::action('ConfigCustomerController@index');
    }

    public function update($id)
    {
        $input = Input::except('_token');
        $group = CustomerManage::where('customer_id', $id)->first();
        if ($group) {
            $group->update(['customer_group_id' => $input['customer_group_id']]);
        }
        else {
            CustomerManage::create([
                'customer_group_id' => $input['customer_group_id'],
                'customer_id' => $id,
            ]);
        }
        return Redirect::action('ConfigCustomerController@index');

    }
    public function show($id)
    {
        $data = CustomerShip::find($id);
        // dd($data);
        $group = CustomerManage::where('customer_id', $id)->first();
        if ($group) {
            $customerGroup = $group->customer_group_id;
        } else {
            $customerGroup = null;
        }
        $listPersonal = CustomerGroup::lists('name', 'id');
        return View::make('admin.customer-group.config.show')->with(compact('data', 'listPersonal', 'customerGroup'));
    }
    
}
