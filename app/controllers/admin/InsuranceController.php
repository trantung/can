<?php

class InsuranceController extends AdminController {

    const PERSONAL_ID       = 'personal_id';
    const CREATED_BY        = 'created_by';
    const UPDATED_BY        = 'updated_by';
    const ID                = 'id';
    const KEYWORD = 'keyword';
    const COMPANY_CATEGORY_ID = 'company_category_id';
    const INCORPORATION     = 'incorporation';
    const FULLNAME          = 'ho_ten';

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
    public function statistics()
    {
        $input =  Input::only(
            self::KEYWORD,
            self::INCORPORATION,
            'start_date',
            'end_date'
            );
        $data = Insurance::where(function ($query) use ($input){
                // if ($input[self::KEYWORD]) {
                //     $query = $query ->orWhere(self::ID, '=', intval( str_replace(['NV','Nv','nV','nv'], [''], $input[self::KEYWORD])));

                // }
                if ($input['start_date']){
                 $query = $query->where('pay_time', '>=' ,$input['start_date']);
                }
                if ($input['end_date']){
                 $query = $query->where('pay_time', '<=' ,$input['end_date'].' 23:59:59');
                                // ->orWhere( self::FULLNAME, 'like', '%'.$input[self::KEYWORD].'%')
                                // ->orWhere( self::IDCARD, 'like', '%'.$input[self::KEYWORD].'%')
                                // ->orWhere( self::BANK_NAME, 'like', '%'.$input[self::KEYWORD].'%')
                                // // ->orWhere( self::FULLNAME, 'like', '%'.$input[self::KEYWORD].'%')
                                // ->orWhere( self::ADDRESS, 'like', '%'.$input[self::KEYWORD].'%')
                                // ->orWhere( self::ADDRESS2, 'like', '%'.$input[self::KEYWORD].'%')
                                // ->orWhere( self::MOBILE, 'like', '%'.$input[self::KEYWORD].'%')
                                // ->orWhere( self::EMAIL, 'like', '%'.$input[self::KEYWORD].'%')
                                // ->orWhere(self::ID, '=', intval( str_replace(['NV','Nv','nV','nv'], [''], $input[self::KEYWORD])) );
                }
                if ($input['incorporation']) {
                    $query = $query->where('incorporation', '=', $input['incorporation']);
                }

                // if ($input[self::NOI_SINH]) {
                //     $query = $query->where(self::NOI_SINH, $input[self::NOI_SINH]);
                // }
            })
            ->whereHas('user', function ($query) use ($input){
                if ($input[self::KEYWORD]) {
                    //
                    if (!ctype_digit( str_replace(['NV','Nv','nV','nv'], [''], $input[self::KEYWORD]) )) {
                        // contains non numeric characters
                        $query = $query->where( self::FULLNAME, 'like', '%'.$input[self::KEYWORD].'%');
                    }else{
                        $query = $query->where(self::ID, '=', intval( str_replace(['NV','Nv','nV','nv'], [''], $input[self::KEYWORD])));
                    }
                }



                // if ($input[self::NOI_SINH]) {
                //     $query = $query->where(self::NOI_SINH, $input[self::NOI_SINH]);
                // }
            })->orderBy('id', 'asc')->paginate(PAGINATE);
        $result = [
            self::COMPANY_CATEGORY_ID       =>$this->buildArrayData2(Company::orderBy('id', 'asc')->get() ),
            'search'=> $input,
            'data'=>$data
        ];

        return View::make('admin.insurance.statistics')->with($result);
    }

    public function detailSearch($user_id)
    {
        $input =  Input::only(
            'start_date',
            'end_date'
            );

        $data = Insurance::where(function ($query) use ($input){
                if ($input['start_date']){
                 $query = $query->where('pay_time', '>=' ,$input['start_date']);
                }
                if ($input['end_date']){
                 $query = $query->where('pay_time', '<=' ,$input['end_date'].' 23:59:59');
                }
            })->where('personal_id', '=', $user_id )->orderBy('id', 'asc');

        $result = [
            'search'=> $input,
            // 'data'=>$data,
            'user'=>PersonalInfo::find($user_id),
            'BHYT'=>$data->sum('BHYT'),
            'BHXH'=>$data->sum('BHXH'),
            'data'=>$data->paginate(PAGINATE)
        ];
        //
        return View::make('admin.insurance.statistics-detail')->with($result);
    }

    protected function buildArrayData2($data, $subTable = null)
    {
        $result = [
        '' => '--',
        ];

        if ($data->count() == 0) {
           return  $result;
        }
        foreach ($data as $key => $value) {
            if ($subTable) {
                $result[$value->$subTable] = $value->name;
            }else{
                $result[$value->id] = $value->name;
            }
        }

        return $result;
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
            'month'   => 'required| digits_between:1,12',
            'bhyt'   => 'required|integer',
            'bhxh'   => 'required|integer',
            // 'total'   => 'required',
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
            $mainPosition = EmploymentHistory::where('personal_id', $input['personal_id'])->where('is_main_position', '=', 'Y')->first();
            if (!$mainPosition) {
                throw new Exception("Nhân viên được đóng bảo hiểm phải đang công tác tại vị trí cụ thể", 1);

            }
            $input['incorporation'] = $mainPosition->position;

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
            // 'month'   => 'required| digits_between:1,12',
            'bhyt'   => 'required|integer',
            'bhxh'   => 'required|integer',
            // 'total'   => 'required',
            // 'description'      => 'required',
            'pay_time'    => 'required',
        );
        $input = Input::only('bhyt','bhxh', 'pay_time', 'description');
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
