<?php

class InsuranceController extends AdminController {

    const PERSONAL_ID       = 'personal_id';
    const CREATED_BY        = 'created_by';
    const UPDATED_BY        = 'updated_by';
    const ID                = 'id';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Insurance::orderBy('id', 'asc')->with('user')->paginate(PAGINATE);
        return View::make('admin.insurance.index')->with(compact('data'));
    }

    public function search()
    {
        // $input = Input::all();
        // if (!$input['keyword'] && !$input['role_id'] && $input['start_date'] && $input['end_date']) {
        //     return Redirect::action('InsuranceController@index');
        // }
        // $data = AdminManager::searchUserOperation($input);
        // return View::make('admin.insurance.index')->with(compact('data'));
    }

    protected function buildArrayData($data, $subTable = null)
    {
        $result = [];

        if ($data->count() == 0) {
           return  $result;
        }


        foreach ($data as $key => $value) {
            if ($subTable) {
                $result[$value->$subTable] = $value->ho_ten;
            }else{
                $result[$value->id] = $value->ho_ten;
            }
        }

        return $result;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $personal = $this->buildArrayData( PersonalInfo::select('ho_ten', 'id')->get() );

        return View::make('admin.insurance.create')->with(['personal'=> $personal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'personal_id'   => 'required',
            'month'   => 'required',
            'total'   => 'required',
            // 'description'      => 'required',
            'pay_time'    => 'required',
        );
        $input = Input::except('_token');
        $validator = Validator::make($input,$rules);
        if($validator->fails()) {
            return Redirect::action('InsuranceController@create')
                ->withErrors($validator)
                ->withInput(Input::except('_token'));
        } else {

            $id = Insurance::create($input)->id;
            if($id) {
                return Redirect::action('InsuranceController@index');
            } else {
                dd('Error');
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $currentUserId = Auth::admin()->get()->id;
        $currentRoleId = Auth::admin()->get()->role_id;
        if($currentRoleId <> ADMIN) {
            if($id <> $currentUserId) {
                dd('error permission');
            }
        }

        $data = Insurance::with('user')->find($id);
        return View::make('admin.insurance.edit', array('data'=>$data));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            // 'personal_id'   => 'required',
            // 'month'   => 'required',
            'total'   => 'required',
            // 'description'      => 'required',
            'pay_time'    => 'required',
        );
        $input = Input::only('total', 'pay_time', 'description');
        $validator =  Validator::make($input,$rules);
        if($validator->fails()) {
            return Redirect::action('InsuranceController@edit',['id'=>$id])
                ->withErrors($validator)->withInput(Input::except('_token'));
        }

        $input[self::CREATED_BY] = Auth::admin()->get()->id;
        $input[self::UPDATED_BY] = Auth::admin()->get()->id;

        $result = Insurance::where(self::ID, $id)->update(array_filter($input));
        if(!$result) {
            dd('Error');
        }
        return Redirect::action('InsuranceController@index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Insurance::find($id)->delete();
        return Redirect::action('InsuranceController@index');
    }

}
