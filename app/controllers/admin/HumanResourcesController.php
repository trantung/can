<?php

class HumanResourcesController extends AdminController {

    const ID                = 'id';
    const IDCARD            = 'idcard';
    const DATE_OF_ISSUE     =  'date_of_issue';
    const IMAGE             = 'image';
    const PLACE_OF_ISSUE    = 'place_of_issue';
    const SEX               = 'sex';
    const TAX_CODE          = 'tax_code';
    const INSURANCE_ID      = 'insurance_id';
    const BANK_ID           = 'bank_id';
    const BANK_NAME         = 'bank_name';
    const COMPANY_ID        = 'company_id';
    const FULLNAME          = 'fullname';
    const ID_EMPLOYEES       = 'id_employees';
    const NICKNAME          = 'nickname';
    const BIRTHDAY          = 'birthday';
    const ADDRESS           = 'address';
    const MARRY             = 'marry';
    const MOBILE            = 'mobile';
    const EMAIL             = 'email';
    const ETHINIC_GROUP_ID  ='ethnic_group_id';
    const NATIONNALITY_ID   ='nationnality_category_id';
    const BRANCH_ID         = 'branch_category_id';
    const POSITION_ID       = 'position_category_id';
    const EMPLOYEES_CATEGORY_ID = 'employees_category_id';
    const RELIGION_CATEGORY_ID       = 'religion_category_id';
    const CONTRACT_CATEGORY_ID = 'contract_category_id';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = PersonalInfo::orderBy('id', 'asc')->paginate(PAGINATE);

        $ethnic_group_id = ['Dân tộc', 'Kinh', 'Ede', 'Khác'];
       $contract_category_id = ['Loại hợp đồng', 'ngan han', 'dai han', 'Khác'];
       $religion_category_id = ['Tôn giáo', 'khong', 'Phat', 'Khác'];
       $branch_category_id = ['Chi nhánh', 'So 1', 'So 2', 'Khác'];
       $position_category_id = ['Chức vụ', 'Giam doc', 'CTO', 'CEO'];
       $employees_category_id = ['Loại nhân viên', 'Lao động phổ thông Full time', 'Lao động phổ thông parttime', 'Chuyên viên'];
       $nationnality_category_id = ['Việt Nam', 'Lào ', 'Anh', 'Mỹ'];
        $result = [
            'ethnic_group_id'=>$ethnic_group_id,
            'religion_category_id'=>$religion_category_id,
            'contract_category_id'=>$contract_category_id,
            'branch_category_id'=>$branch_category_id,
            'position_category_id'=>$position_category_id,
            'employees_category_id'=>$employees_category_id,
            'nationnality_category_id'=>$nationnality_category_id,
            'data'=>$data,
        ];
        // return View::make('admin.hr.index')->with(compact('data'));
        return View::make('admin.hr.index', $result);
    }

    public function search()
    {
        // $input = Input::all();
        // if (!$input['keyword'] && !$input['role_id'] && $input['start_date'] && $input['end_date']) {
        //     return Redirect::action('HumanResourcesController@index');
        // }
        // $data = AdminManager::searchUserOperation($input);
        // return View::make('admin.hr.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       $ethnic_group_id = ['Dân tộc', 'Kinh', 'Ede', 'Khác'];
       $contract_category_id = ['Loại hợp đồng', 'ngan han', 'dai han', 'Khác'];
       $religion_category_id = ['Tôn giáo', 'khong', 'Phat', 'Khác'];
       $branch_category_id = ['Chi nhánh', 'So 1', 'So 2', 'Khác'];
       $position_category_id = ['Chức vụ', 'Giam doc', 'CTO', 'CEO'];
       $employees_category_id = ['Loại nhân viên', 'Lao động phổ thông Full time', 'Lao động phổ thông parttime', 'Chuyên viên'];
       $nationnality_category_id = ['Việt Nam', 'Lào ', 'Anh', 'Mỹ'];
        $result = [
            'ethnic_group_id'=>$ethnic_group_id,
            'religion_category_id'=>$religion_category_id,
            'contract_category_id'=>$contract_category_id,
            'branch_category_id'=>$branch_category_id,
            'position_category_id'=>$position_category_id,
            'employees_category_id'=>$employees_category_id,
            'nationnality_category_id'=>$nationnality_category_id,
        ];

        return View::make('admin.hr.create', $result);
        // return View::make('admin.hr.create');
    }

    public function getAndValidateInput($rules)
    {
        $input = Input::only(
            self::IDCARD,
            self::DATE_OF_ISSUE,
            // self::IMAGE,
            self::PLACE_OF_ISSUE,
            self::SEX,
            self::TAX_CODE,
            self::INSURANCE_ID,
            self::BANK_ID,
            self::BANK_NAME,
            // self::COMPANY_ID,
            self::FULLNAME,
            self::ID_EMPLOYEES,
            self::NICKNAME,
            self::BIRTHDAY,
            self::ADDRESS,
            self::MARRY,
            self::MOBILE,
            self::EMAIL,
            self::ETHINIC_GROUP_ID,
            self::NATIONNALITY_ID,
            self::BRANCH_ID,
            self::POSITION_ID,
            self::EMPLOYEES_CATEGORY_ID,
            self::RELIGION_CATEGORY_ID,
            self::CONTRACT_CATEGORY_ID
            );
        $validator = Validator::make($input,$rules);
        if($validator->fails()) {
            return Redirect::action('HumanResourcesController@create')
                ->withErrors($validator);
        }
        $input[self::CREATED_BY] = Auth::admin()->get()->id;
        $input[self::UPDATED_BY] = Auth::admin()->get()->id;

        return $input;
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
                // sefl::IDCARD   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::DATE_OF_ISSUE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::IMAGE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::PLACE_OF_ISSUE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::NATIONNALITY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::SEX   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::ETHINIC_GROUP_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::RELIGION_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::CONTRACT_CATEGORY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::TAX_CODE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::INSURANCE_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::BANK_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::BANK_NAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::COMPANY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::BRANCH_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::POSITION_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::EMPLOYEES_CATEGORY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::FULLNAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::ID_EMPLOYEES   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::NICKNAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::BIRTHDAY   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::ADDRESS   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::MARRY   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::MOBILE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::EMAIL   => 'required|unique:admins,deleted_at,NULL|unique_delete',
            );
            $input = $this->getAndValidateInput($rules);
            $id = PersonalInfo::create($input)->id;
            if($id) {
                return Redirect::action('HumanResourcesController@index');
            } else {
                dd('Error');
            }

        } catch (Exception $e) {

            return $this->returnError($e);
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
        dd('show');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // dd(1);
        try {
           $personal = PersonalInfo::find($id);
           $ethnic_group_id = ['Dân tộc', 'Kinh', 'Ede', 'Khác'];
           $contract_category_id = ['Loại hợp đồng', 'ngan han', 'dai han', 'Khác'];
           $religion_category_id = ['Tôn giáo', 'khong', 'Phat', 'Khác'];
           $branch_category_id = ['Chi nhánh', 'So 1', 'So 2', 'Khác'];
           $position_category_id = ['Chức vụ', 'Giam doc', 'CTO', 'CEO'];
           $employees_category_id = ['Loại nhân viên', 'Lao động phổ thông Full time', 'Lao động phổ thông parttime', 'Chuyên viên'];
           $nationnality_category_id = ['Việt Nam', 'Lào ', 'Anh', 'Mỹ'];
        } catch (Exception $e) {

            return $this->returnError($e);
        }
        $result = [
            'personal'=>$personal,
            'ethnic_group_id'=>$ethnic_group_id,
            'religion_category_id'=>$religion_category_id,
            'contract_category_id'=>$contract_category_id,
            'branch_category_id'=>$branch_category_id,
            'position_category_id'=>$position_category_id,
            'employees_category_id'=>$employees_category_id,
            'nationnality_category_id'=>$nationnality_category_id,
        ];
        return View::make('admin.hr.edit', $result);
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
                // sefl::IDCARD   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::DATE_OF_ISSUE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::IMAGE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::PLACE_OF_ISSUE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::NATIONNALITY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::SEX   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::ETHINIC_GROUP_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::RELIGION_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::CONTRACT_CATEGORY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::TAX_CODE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::INSURANCE_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::BANK_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::BANK_NAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::COMPANY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::BRANCH_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::POSITION_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::EMPLOYEES_CATEGORY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::FULLNAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::ID_EMPLOYEES   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::NICKNAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::BIRTHDAY   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::ADDRESS   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::MARRY   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::MOBILE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::EMAIL   => 'required|unique:admins,deleted_at,NULL|unique_delete',
            );
            $input = $this->getAndValidateInput($rules);
            // dd($input);

            $result = PersonalInfo::where(self::ID, $id)->update($input);
            if(!$result) {
                dd('Error');
            }
        } catch (Exception $e) {
            return $this->returnError($e);
        }
        return Redirect::action('HumanResourcesController@index');
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



}
