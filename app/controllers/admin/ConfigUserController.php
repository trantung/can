<?php

class ConfigUserController extends AdminController {


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
        $listUser = Admin::all();
        $listPersonal = PersonalInfo::all();
        return View::make('admin.user.config.create')->with(compact('listUser', 'listPersonal'));
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
            $inputPrimaryKey = ['user_id' => $input['user_id']];
            $inputSave = ['personal_id' => array_keys($input['personal'])];
            Common::saveOneToMany('UserPersonal', $inputPrimaryKey, $inputSave);
        }
        return Redirect::action('ConfigUserController@index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $listUser = Admin::all();
        $listPersonal = PersonalInfo::lists('ho_ten', 'id');
        foreach ($listUser as $key => $value) {
            $data[$key] = new stdClass();
            $data[$key] = $value;
            $data[$key]->personals = UserPersonal::where('user_id', $value->id)->lists('personal_id');
        }
        return View::make('admin.user.config.index')->with(compact('data', 'listPersonal'));
    }

    public function edit($id)
    {
        $data = Admin::find($id);
        $listPersonal = PersonalInfo::all();
        return View::make('admin.user.config.edit')->with(compact('data', 'listPersonal'));
    }

    public function destroy($id)
    {
        UserPersonal::where('user_id', $id)->delete();
        return Redirect::action('ConfigUserController@index');
    }

    public function update($id)
    {
        $input = Input::except('_token');
        UserPersonal::where('user_id', $id)->delete();
        if (isset($input['personal'])) {
            $inputPrimaryKey = ['user_id' => $id];
            $inputSave = ['personal_id' => array_keys($input['personal'])];
            Common::saveOneToMany('UserPersonal', $inputPrimaryKey, $inputSave);
        }
        return Redirect::action('ConfigUserController@index');
    }
    
}
