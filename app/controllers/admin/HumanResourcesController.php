<?php

class HumanResourcesController extends AdminController {
const IDCARD            = 'idcard';
const DATE_OF_ISSUE     =  'date_of_issue';
const IMAGE             = 'image';
const PLACE_OF_ISSUE    = 'place_of_issue';
const NATIONNALITY_ID   ='nationnality_id';
const SEX               = 'sex';
const ETHINIC_GROUP_ID  ='ethnic_group_id';
const RELIGION_ID       = 'religion_id';
const CONTRACT_CATEGORY_ID = 'contract_category_id';
const TAX_CODE          = 'tax_code';
const INSURANCE_ID      = 'insurance_id';
const BANK_ID           = 'bank_id';
const BANK_NAME         = 'bank_name';
const COMPANY_ID        = 'company_id';
const BRANCH_ID         = 'branch_id';
const POSITION_ID       = 'position_id';
const PERSONAL_CATEGORY_ID = 'personal_category_id';
const FULLNAME          = 'fullname';
const ID_PRESONAL       = 'id_personal';
const NICKNAME          = 'nickname';
const BIRTHDAY          = 'birthday';
const ADDRESS           = 'address';
const MARRY             = 'marry';
const MOBILE            = 'mobile';
const EMAIL             = 'email';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $data = Admin::orderBy('id', 'asc')->paginate(PAGINATE);
        // return View::make('admin.hr.index')->with(compact('data'));
        return View::make('admin.hr.index');
    }

    public function search()
    {
        $input = Input::all();
        if (!$input['keyword'] && !$input['role_id'] && $input['start_date'] && $input['end_date']) {
            return Redirect::action('HumanResourcesController@index');
        }
        $data = AdminManager::searchUserOperation($input);
        return View::make('admin.hr.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.hr.create');
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
                // sefl::PERSONAL_CATEGORY_ID   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::FULLNAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::ID_PRESONAL   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::NICKNAME   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::BIRTHDAY   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::ADDRESS   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::MARRY   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::MOBILE   => 'required|unique:admins,deleted_at,NULL|unique_delete',
                // sefl::EMAIL   => 'required|unique:admins,deleted_at,NULL|unique_delete',
            );
            $input = Input::only(
                self::IDCARD,
                self::DATE_OF_ISSUE,
                // self::IMAGE,
                self::PLACE_OF_ISSUE,
                self::NATIONNALITY_ID,
                self::SEX,
                self::ETHINIC_GROUP_ID,
                self::RELIGION_ID,
                self::CONTRACT_CATEGORY_ID,
                self::TAX_CODE,
                self::INSURANCE_ID,
                self::BANK_ID,
                self::BANK_NAME,
                // self::COMPANY_ID,
                self::BRANCH_ID,
                self::POSITION_ID,
                self::PERSONAL_CATEGORY_ID,
                self::FULLNAME,
                self::ID_PRESONAL,
                self::NICKNAME,
                self::BIRTHDAY,
                self::ADDRESS,
                self::MARRY,
                self::MOBILE,
                self::EMAIL
                );
            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::action('HumanResourcesController@create')
                    ->withErrors($validator);
            } else {
                // $input['password'] = Hash::make($input['password']);
                $id = PersonalInfo::create($input)->id;
                if($id) {
                    return Redirect::action('HumanResourcesController@index');
                } else {
                    dd('Error');
                }
            }

        } catch (Exception $e) {
            $this->returnError($e);
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

        $data = Admin::find($id);
        return View::make('admin.hr.edit', array('data'=>$data));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array();
        $rules = array(
            'username'   => 'required',
            // 'password'   => 'required',
            'email'      => 'required|email',
            'role_id'    => 'required',
        );
        if (!Admin::isAdmin()) {
            unset($rules['role_id']);
        }
        $input = Input::except('_token');

        $validator = Validator::make($input,$rules);
        if($validator->fails()) {
            return Redirect::action('HumanResourcesController@edit', $id)
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            if($input['password'] != '') {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input['password'] = Auth::admin()->get()->password;
            }
            CommonNormal::update($id, $input);
            $currentUserId = Auth::admin()->get()->id;
            $currentRoleId = Auth::admin()->get()->role_id;
            if($currentRoleId <> ADMIN) {
                return Redirect::action('HumanResourcesController@edit', $id);
            }
            return Redirect::action('HumanResourcesController@index');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        CommonNormal::delete($id);
        return Redirect::action('HumanResourcesController@index');
    }

    public function changePassword($id){
        $currentUserId = Auth::admin()->get()->id;
        $currentRoleId = Auth::admin()->get()->role_id;
        if($currentRoleId <> ADMIN) {
            if($id <> $currentUserId) {
                dd('error permission');
            }
        }

        $data = Admin::find($id);
        return View::make('admin.hr.changepassword')->with(compact('data'));
    }

    public function updatePassword($id){
        $rules = array(
            'password'   => 'required',
            'repassword' => 'required|same:password'
        );
        $input = Input::except('_token');
        $validator = Validator::make($input,$rules);
        if($validator->fails()) {
            return Redirect::action('HumanResourcesController@changePassword',$id)
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
                $inputPass['password'] = Hash::make($input['password']);
                CommonNormal::update($id, $inputPass);
        }
        return Redirect::action('HumanResourcesController@changePassword', $id)->with('message', 'Đổi mật khẩu thành công!');
    }

}
