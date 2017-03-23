<?php

class HumanResourcesController extends AdminController {

    const ID                = 'id';
    const MA_NHAN_VIEN      = 'ma_nhan_vien';
    const VI_TRI            = 'vi_tri';
    const NAME              = 'ten';
    const IDCARD            = 'cmt';
    const DATE_OF_ISSUE     =  'date_of_issue';
    const IMAGE             = 'image';
    const NOI_SINH          = 'noi_sinh';
    const EMPLOYMENT_OFF          = 'employment_off';
    const EMPLOYMENT_KIND          = 'loai_nhan_vien';
    const CURRENCY_CATEGORY          = 'currency_category';
    const CV                = 'cv';
    const INCORPORATION     = 'incorporation';
    const PLACE_OF_ISSUE    = 'place_of_issue';
    const SEX               = 'sex';
    const TAX_CODE          = 'ma_so_thue';
    const INSURANCE_ID      = 'insurance_id';
    const BANK_ID           = 'so_tai_khoan';
    const BANK_NAME         = 'ngan_hang';
    const COMPANY_ID        = 'company_id';
    const FULLNAME          = 'ho_ten';
    const ID_EMPLOYEES       = 'id_employees';
    const EMPLOYEES         = 'employees';
    const NICKNAME          = 'nickname';
    const BIRTHDAY          = 'birthday';
    const ADDRESS           = 'dia_chi_thuong_tru';
    const ADDRESS2           = 'dia_chi_tam_tru';
    const MARRY             = 'marry';
    const MOBILE            = 'mobile';
    const EMAIL             = 'email';
    const CREATED_BY             = 'created_by';
    const UPDATED_BY             = 'updated_by';
    const ETHNIC_GROUP_ID  ='dan_toc';
    const NATIONALITY_ID   ='nationality_category_id';
    const BRANCH_ID         = 'branch_category_id';
    const POSITION_ID       = 'position_category_id';
    const EMPLOYEES_CATEGORY_ID = 'employees_category_id';
    const RELIGION_CATEGORY_ID       = 'religion_category_id';
    const CONTRACT_CATEGORY_ID = 'contract_category_id';
    const INDUSTRY_CATEGORY_ID = 'industry_category_id';
    const CERTIFICATE_CATEGORY_ID = 'certificate_category_id';
    const COMPANY_CATEGORY_ID = 'company_category_id';

    const KEYWORD = 'keyword';

    protected function getAllCategory($key, $value)
    {
        // if (debug_backtrace()[1]['function'] == 'index') {
        //     $branch = $this->buildArrayData( Branch::orderBy('id', 'asc')->get());
        // }else{

        //     $branch = $this->buildArrayData( Company::orderBy('id', 'asc')->with('branchs')->get(),'branchs' );
        // }

        // dd(Province::get()->toArray());
       return [
            'danh_sach_dan_toc'           =>$this->buildArrayData(Ethnic::orderBy('id', 'asc')->get() ),
            'danh_sach_ton_giao'          =>$this->buildArrayData(Religion::orderBy('id', 'asc')->get() ),
            // self::CONTRACT_CATEGORY_ID      =>$this->buildArrayData(Contract::orderBy('id', 'asc')->get() ),
            self::COMPANY_CATEGORY_ID       =>$this->buildArrayData(Company::orderBy('id', 'asc')->get() ),
            self::POSITION_ID               =>$this->buildArrayData(Position::orderBy('id', 'asc')->get() ),
            // self::BRANCH_ID                 =>$this->buildArrayData(Branch::orderBy('id', 'asc')->get() ),
            // self::BRANCH_ID                 =>$branch,
            'vi_tri'               =>$this->buildArrayData(Position::orderBy('id', 'asc')->get() ),
            'thanh_pho'               =>$this->buildArrayData(Province::get(), 'provinceid' ),
            // self::EMPLOYEES_CATEGORY_ID     =>$this->buildArrayData(Employees::orderBy('id', 'asc')->get() ),
            'danh_sach_quoc_gia'            =>$this->buildArrayData(Nationality::orderBy('id', 'asc')->get() ),
            'quoc_gia'      =>$this->buildArrayData(Industry::orderBy('id', 'asc')->get() ),
            'bang_cap'   =>$this->buildArrayData(Certificate::orderBy('id', 'asc')->get() ),
            // 'danh_sach_don_vi' => $this->buildArrayData(::orderBy('id', 'asc')),
            // 'danh_sach_chuc_danh' => $this->buildArrayData(::orderBy('id', 'asc')),
            // 'danh_sach_phong_ban' => $this->buildArrayData(::orderBy('id', 'asc')),
            // 'danh_sach_chuc_vu' => $this->buildArrayData(::orderBy('id', 'asc')),
            // 'danh_sach_bo_phan' => $this->buildArrayData(::orderBy('id', 'asc')),
            // 'danh_sach_dia_diem_lam_viec' => $this->buildArrayData(::orderBy('id', 'asc')),
            'danh_sach_tien_te' => $this->buildArrayData(CurrencyCategory::orderBy('id', 'asc')->get()),
            'danh_sach_ngan_hang' => $this->buildArrayData(BankCategory::orderBy('id', 'asc')->get()),
            'danh_sach_loai_nhan_vien' => $this->buildArrayData(Employees::orderBy('id', 'asc')->get()),
            'officer_category_id' => $this->buildArrayData(Officer::orderBy('id', 'asc')->get()),
            'bonus_category_id' => $this->buildArrayData(BonusCategory::orderBy('id', 'asc')->get()),
            self::INDUSTRY_CATEGORY_ID      =>$this->buildArrayData(Industry::orderBy('id', 'asc')->get() ),
            self::CERTIFICATE_CATEGORY_ID   =>$this->buildArrayData(Certificate::orderBy('id', 'asc')->get() ),
            $key => $value,
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input =  Input::only(
            self::KEYWORD,
            self::MA_NHAN_VIEN,
            self::NOI_SINH,
            self::VI_TRI,
            self::EMPLOYMENT_OFF,
            self::ETHNIC_GROUP_ID,
            self::RELIGION_CATEGORY_ID,
            self::EMPLOYEES_CATEGORY_ID,
            self::ID_EMPLOYEES,
            self::BRANCH_ID,
            self::POSITION_ID,
            self::NATIONALITY_ID,
            self::CONTRACT_CATEGORY_ID,
            self::INDUSTRY_CATEGORY_ID,
            self::INCORPORATION,
            self::CERTIFICATE_CATEGORY_ID
            );
        // $data = PersonalInfo::where(function ($query) use ($input){
        //     if ($input[self::KEYWORD]) {
        //         $query = $query->where(self::EMAIL, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::NICKNAME, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::IDCARD, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::TAX_CODE, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::BANK_ID, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::BANK_NAME, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::FULLNAME, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::ID_EMPLOYEES, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::NICKNAME, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::ADDRESS, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::MOBILE, 'like', '%'.$input[self::KEYWORD].'%')
        //                         ->orWhere( self::EMAIL, 'like', '%'.$input[self::KEYWORD].'%');
        //     }
        //     if ($input[self::ETHNIC_GROUP_ID]) {
        //         $query = $query->where(self::ETHNIC_GROUP_ID, $input[self::ETHNIC_GROUP_ID]);
        //     }
        //     if ($input[self::RELIGION_CATEGORY_ID]) {
        //         $query = $query->where(self::RELIGION_CATEGORY_ID, $input[self::RELIGION_CATEGORY_ID]);
        //     }
        //     if ($input[self::EMPLOYEES_CATEGORY_ID]) {
        //         $query = $query->where(self::EMPLOYEES_CATEGORY_ID, $input[self::EMPLOYEES_CATEGORY_ID]);
        //     }
        //     if ($input[self::ID_EMPLOYEES]) {
        //         $query = $query->where(self::ID_EMPLOYEES, $input[self::ID_EMPLOYEES]);
        //     }
        //     if ($input[self::BRANCH_ID]) {
        //         $query = $query->where(self::BRANCH_ID, $input[self::BRANCH_ID]);
        //     }
        //     if ($input[self::POSITION_ID]) {
        //         $query = $query->where(self::POSITION_ID, $input[self::POSITION_ID]);
        //     }
        //     if ($input[self::NATIONALITY_ID]) {
        //         $query = $query->where(self::NATIONALITY_ID, $input[self::NATIONALITY_ID]);
        //     }
        //     if ($input[self::CONTRACT_CATEGORY_ID]) {
        //         $query = $query->where(self::CONTRACT_CATEGORY_ID, $input[self::CONTRACT_CATEGORY_ID]);
        //     }
        //     if ($input[self::INDUSTRY_CATEGORY_ID]) {
        //         $query = $query->where(self::INDUSTRY_CATEGORY_ID, $input[self::INDUSTRY_CATEGORY_ID]);
        //     }
        //     if ($input[self::CERTIFICATE_CATEGORY_ID]) {
        //         $query = $query->where(self::CERTIFICATE_CATEGORY_ID, $input[self::CERTIFICATE_CATEGORY_ID]);
        //     }
        // })->orderBy(self::ID, 'desc')->paginate(PAGINATE);
        // $data = PersonalInfo::orderBy(self::ID, 'desc')->with('EmploymentMainPosition')->paginate(PAGINATE);
        $data = PersonalInfo::where(function ($query) use ($input){
                if ($input[self::KEYWORD]) {
                    $query = $query->orWhere( self::FULLNAME, 'like', '%'.$input[self::KEYWORD].'%')
                                    // ->orWhere( self::IDCARD, 'like', '%'.$input[self::KEYWORD].'%')
                                    // ->orWhere( self::BANK_NAME, 'like', '%'.$input[self::KEYWORD].'%')
                                    // ->orWhere( self::FULLNAME, 'like', '%'.$input[self::KEYWORD].'%')
                                    ->orWhere( self::ADDRESS, 'like', '%'.$input[self::KEYWORD].'%')
                                    ->orWhere( self::ADDRESS2, 'like', '%'.$input[self::KEYWORD].'%')
                                    ->orWhere( self::MOBILE, 'like', '%'.$input[self::KEYWORD].'%')
                                    ->orWhere( self::EMAIL, 'like', '%'.$input[self::KEYWORD].'%')
                                    ->orWhere(self::ID, '=', intval( str_replace(['NV','Nv','nV','nv'], [''], $input[self::KEYWORD])) );
                }

                if ($input[self::NOI_SINH]) {
                    $query = $query->where(self::NOI_SINH, $input[self::NOI_SINH]);
                }
            })
            ->with('EmploymentMainPosition')
            ->whereEmploymentOff($input[self::EMPLOYMENT_OFF])
            ->whereWithPosition($input[self::VI_TRI])
            ->whereWithIncorporation($input[self::INCORPORATION])

        // ->with(array('EmploymentMainPosition' => function($query) use ($input) {
        //             $query->where('employment_history.position', $input[self::VI_TRI] );
        //             dd($query);
        //         }))
        ->orderBy(self::ID, 'desc')
        // ->toSql();

        // ->paginate(1);
        ->paginate(PAGINATE);
                // dd($input);
        // $data = PersonalInfo::join('employment_history', function($join)
        // {
        //     $join->on('employment_history.personal_id', '=', 'personal_info.id');
        //          // ->where('employment_history.status','=',BONUSHISTORY)
        //          // ->orWhere('employment_history.status','=',NULL);
        //          // ->where('employment_history.is_main_position','=', 'Y');
        // })
        // ->join('positions', 'positions.id', '=', 'employment_history.position')
        // // ->select(
        // //     // 'employment_history.personal_id as personal_id',
        // //     // 'employment_history.position as position',
        // //     // 'employment_history.is_main_position as is_main_position',
        // //     'employment_history.company_name_text as company_name_text',
        // //     'personal_info.id as id',
        // //     'personal_info.ho_ten as ho_ten',
        // //     'personal_info.nam_sinh as nam_sinh',
        // //     // 'positions.id as positions_id',
        // //     'positions.name as positions_name'
        // //     )
        // ->paginate(PAGINATE);
        // $data = EmploymentHistory::with('personalInfo')->with('positionHistory')->where('is_main_position', 'Y')->paginate(PAGINATE);
        $result = $this->getAllCategory('data', $data);
        $result['search'] = $input;
        // dd($data->toJson());
        return View::make('admin.hr.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $result = $this->getAllCategory('data', null);

        // dd($result);
        return View::make('admin.hr.create', $result);
        // return View::make('admin.hr.create');
    }

    public function getInput()
    {
        return Input::only(
            // 'ma_nv',
            'ho_ten',
            'ten_thuong_goi',
            'image',
            'gioi_tinh',
            'nam_sinh',
            'noi_sinh',
            'cmt',
            'ngay_cap',
            'noi_cap',
            'dia_chi_thuong_tru',
            'dia_chi_tam_tru',
            'mobile',
            'email',
            'dan_toc',
            'ton_giao',
            'quoc_tich',
            'ho_chieu',
            'ngay_cap_ho_chieu',
            'noi_cap_ho_chieu',
            'tinh_trang_hon_nhan',
            'ma_so_thue',
            'ngay_cap_mst',
            'so_tai_khoan',
            'ngan_hang',
            'nguyen_quan',
            'ngay_vao_cong_ty',
            'ngay_ket_thuc_thu_viec',
            'bank_category',
            'currency_category',
            'luong_co_ban'
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            $rules = array(
            // 'ma_nv'=>'required|unique:personal_info,ma_nv,NULL|unique_delete',
            'mobile'=>'required|unique:personal_info,mobile,NULL|unique_delete',
            'ho_ten'=>'required',
            'gioi_tinh'=>'required',
            'nam_sinh'=>'required',
            'cmt'=>'required',
            'ngay_cap'=>'required',
            'noi_cap'=>'required',
            );

            $input = $this->getInput();
            $validator =  Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::action('HumanResourcesController@create')
                    ->withErrors($validator)->withInput();
            }
            if(!$input[self::IMAGE]) {
                $input[self::IMAGE] = DEFAULT_PICTURE;
            }else{
                $input[self::IMAGE] = CommonUpload::uploadImage('', UPLOADIMG, self::IMAGE, UPLOAD_EMPLOYEES);
            }
            $input[self::CREATED_BY] = Auth::admin()->get()->id;
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;

            $id = PersonalInfo::create($input)->id;
            if(!$id) {
                dd('Error');
            }

        } catch (Exception $e) {

            return $this->returnError($e);
        }

         return Redirect::route('hr.edit', array($id));
    }

    public function getInfo($id)
    {
        $personal = PersonalInfo::find($id);
        $result = $this->getAllCategory('personal', $personal);
        // dd(Officer::orderBy('id', 'asc')->get()->toJson());
        $employmentHistory = EmploymentHistory::where('personal_id', $id)->where('status',HISTORY)->with('positionHistory')->with('officerHistory')->get();
        $employmentPositions = EmploymentHistory::where('personal_id', $id)->where('status',BONUSHISTORY)->with('positionHistory')->with('officerHistory')->with('attachFile2')->get();
        $employmentBonusHistory = BonusHistory::where('personal_id', $id)->with('categoryName')->get();
        // $officerHistory
        // dd($employmentBonusHistory->toJson());
        $result['employmentHistory'] =  $employmentHistory;
        $result['employmentPositions'] =  $employmentPositions;
        $result['employmentBonusHistory'] =  $employmentBonusHistory;
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $data = Self::getInfo($id);
        return View::make('admin.hr.detail', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $data = Self::getInfo($id);
            // dd($employmentPositions->toJson());

        } catch (Exception $e) {
            return $this->returnError($e);
        }
        return View::make('admin.hr.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try {
            // dd('vao');
            $rules = array(
                // 'ma_nv'=>'required|unique:personal_info,ma_nv,'.$id.'|unique_delete',
                'mobile'=>'required|unique:personal_info,mobile,'.$id.'|unique_delete',
                'ho_ten'=>'required',
                'gioi_tinh'=>'required',
                'nam_sinh'=>'required',
                'cmt'=>'required',
                'ngay_cap'=>'required',
                'noi_cap'=>'required',
                // self::IDCARD   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::DATE_OF_ISSUE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::IMAGE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::CV   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::PLACE_OF_ISSUE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::NATIONALITY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::SEX   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::ETHNIC_GROUP_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::RELIGION_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::CONTRACT_CATEGORY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::TAX_CODE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::INSURANCE_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::BANK_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::BANK_NAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::COMPANY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::BRANCH_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::POSITION_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::EMPLOYEES_CATEGORY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::FULLNAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::ID_EMPLOYEES   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::NICKNAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::BIRTHDAY   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::ADDRESS   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::MARRY   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::MOBILE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // self::EMAIL   => 'required|unique:admins,deleted_at,NULL|unique_delete',
            );
            $input = $this->getInput();
            $validator =  Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::action('HumanResourcesController@edit',['id'=>$id])
                    ->withErrors($validator);
            }
            if($input[self::IMAGE]){
                $input[self::IMAGE] = CommonUpload::uploadImage('', UPLOADIMG, self::IMAGE, UPLOAD_EMPLOYEES);
            }
            $input = array_filter($input);
            // if($input[self::CV]){
            //     $input[self::CV] = CommonUpload::uploadImage('', UPLOADIMG, self::CV, UPLOAD_EMPLOYEES);
            // }

            $input[self::CREATED_BY] = Auth::admin()->get()->id;
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;

            if (Input::get('employment_off') == 'off') {
                $input[self::EMPLOYMENT_KIND] = 1;
            }else{
                $input[self::EMPLOYMENT_KIND] = NULL;
            }
            // dd($input);

            $result = PersonalInfo::where(self::ID, $id)->update($input);
            if(!$result) {
                dd('Error');
            }
        } catch (Exception $e) {
            return $this->returnError($e);
        }
        return Redirect::action('HumanResourcesController@edit',['id'=>$id]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        PersonalInfo::find($id)->delete();
        return Redirect::action('HumanResourcesController@index');
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

    public function birthdaySearch()
    {
        $input =  Input::only(
            'month',
            self::INCORPORATION
            );

        $data = PersonalInfo::where(function ($query) use ($input){
                if ($input['month']){
                    $query = $query->whereRaw('MONTH(nam_sinh) = ?',[$input['month']]);
                }

            })->whereHas('EmploymentMainPosition', function ($query) use ($input){
                if ($input[self::INCORPORATION]){
                    return $query->where('company_name', '=' ,$input[self::INCORPORATION]);
                }
            })->orderBy('id', 'asc');
        // dd($data->paginate(PAGINATE)->toJson());
        $result = [
            'search'=> $input,
            self::COMPANY_CATEGORY_ID       =>$this->buildArrayData2(Company::orderBy('id', 'asc')->get() ),
            // 'data'=>$data,
            // 'user'=>PersonalInfo::find($user_id),
            // 'BHYT'=>$data->sum('BHYT'),
            'position_category_id'=> $this->buildArrayData(Position::orderBy('id', 'asc')->get() ),
            'months'=>['--','Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            'data'=>$data->paginate(PAGINATE)
        ];

        //
        return View::make('admin.dashboard.birthday')->with($result);
    }

}
