<?php

class ManagePartnerController extends AdminController {


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
            $inputPrimaryKey = ['partner_group_id' => $input['partner_group_id']];
            $inputSave = ['partner_id' => array_keys($input['personal'])];
            Common::saveOneToMany('PartnerManage', $inputPrimaryKey, $inputSave);
        }
        return Redirect::action('ManagePartnerController@index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // dd(11);
        // $listUser = PartnerGroup::all();
        $data = Partner::all();
        // $data = [];
        // foreach ($listUser as $key => $value) {
        //     $data[$key] = new stdClass();
        //     $data[$key] = $value;
        //     $data[$key]->customers = PartnerManage::where('partner_group_id', $value->id)->lists('partner_id');
        // }
        return View::make('admin.partner.config.index')->with(compact('data'));
    }

    public function edit($id)
    {
        $data = Partner::find($id);
        // dd($data);
        $group = PartnerManage::where('partner_id', $id)->first();
        if ($group) {
            $customerGroup = $group->partner_group_id;
        } else {
            $customerGroup = null;
        }
        $listPersonal = PartnerGroup::lists('name', 'id');
        return View::make('admin.partner.config.edit')->with(compact('data', 'listPersonal', 'customerGroup'));
    }

    public function destroy($id)
    {
        PartnerManage::where('partner_id', $id)->delete();
        return Redirect::action('ManagePartnerController@index');
    }

    public function update($id)
    {
        $input = Input::except('_token');
        $group = PartnerManage::where('partner_id', $id)->first();
        if ($group) {
            $group->update(['partner_group_id' => $input['partner_group_id']]);
        }
        else {
            PartnerManage::create([
                'partner_group_id' => $input['partner_group_id'],
                'partner_id' => $id,
            ]);
        }
        return Redirect::action('ManagePartnerController@index');

    }
    public function show($id)
    {
        $data = Partner::find($id);
        // dd($data);
        $group = PartnerManage::where('partner_id', $id)->first();
        if ($group) {
            $customerGroup = $group->partner_group_id;
        } else {
            $customerGroup = null;
        }
        $listPersonal = PartnerGroup::lists('name', 'id');
        return View::make('admin.partner.config.show')->with(compact('data', 'listPersonal', 'customerGroup'));
    }
    
}
