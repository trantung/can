<?php

class ConfigPartnerController extends AdminController {


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
        return Redirect::action('ConfigPartnerController@index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $listUser = PartnerGroup::all();
        $listPersonal = PartnerShip::lists('partner_code', 'id');
        $data = [];
        foreach ($listUser as $key => $value) {
            $data[$key] = new stdClass();
            $data[$key] = $value;
            $data[$key]->customers = PartnerManage::where('partner_group_id', $value->id)->lists('partner_id');
        }
        return View::make('admin.partner-group.config.index')->with(compact('data', 'listPersonal'));
    }

    public function edit($id)
    {
        $data = PartnerGroup::find($id);
        $listPersonal = PartnerShip::all();
        return View::make('admin.partner-group.config.edit')->with(compact('data', 'listPersonal'));
    }

    public function destroy($id)
    {
        PartnerManage::where('partner_group_id', $id)->delete();
        return Redirect::action('ConfigPartnerController@index');
    }

    public function update($id)
    {
        $input = Input::except('_token');
        PartnerManage::where('partner_group_id', $id)->delete();
        if (isset($input['list_partner'])) {
            $inputPrimaryKey = ['partner_group_id' => $id];
            $inputSave = ['partner_id' => array_keys($input['list_partner'])];
            Common::saveOneToMany('PartnerManage', $inputPrimaryKey, $inputSave);
        }
        return Redirect::action('ConfigPartnerController@index');

    }
    
}
