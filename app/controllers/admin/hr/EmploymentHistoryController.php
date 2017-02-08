<?php

class EmploymentHistoryController extends AdminController {

    const ID                = 'id';
    const NAME              = 'name';
    const COMPANY_NAME      = 'company_name';
    const BRANCH            = 'branch';
    const POSITION          = 'position';
    const WHY_OUT           = 'why_out';
    const DESCRIPTION       = 'description';
    const PERSONAL_ID       = 'personal_id';
    const CREATED_BY        = 'created_by';
    const UPDATED_BY        = 'updated_by';
    const START_DATE        = 'start_date';
    const END_DATE          = 'end_date';
    const STATUS            = 'status';
    const BRANCH_ID         = 'branch_category_id';
    const POSITION_ID       = 'position_category_id';

    const COMPANY_CATEGORY_ID = 'company_category_id';
    const POSITION_TO_HISTORY = 'Nghỉ kiêm nhiệm';
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeHistory($employment)
    {
        try {
            $rules = array(
                self::COMPANY_NAME   => 'required',
                // self::BRANCH   => 'required|integer',
                self::POSITION   => 'required|integer',
                self::WHY_OUT   => 'required',
                // self::DESCRIPTION   => 'required',
                self::START_DATE   => 'required|date',
                // self::END_DATE   => 'required|date',
            );
            $input = Input::only(
                self::COMPANY_NAME,
                // self::BRANCH,
                self::POSITION,
                self::WHY_OUT,
                self::DESCRIPTION,
                self::START_DATE,
                self::END_DATE
            );

            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::action('HumanResourcesController@edit', array('id' => $employment))
                    ->withErrors($validator)->withAddNewEmployerHistory(TRUE)->withInput();
            }
            $input[self::CREATED_BY] = Auth::admin()->get()->id;
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            $input[self::PERSONAL_ID] = $employment;

            $id = EmploymentHistory::create($input)->id;

        } catch (Exception $e) {

            return $this->returnError($e);
        }

        return Redirect::action('HumanResourcesController@edit', array('id' => $employment));
    }
/**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function newPosition($employment)
    {
        try {
            $rules = array(
                self::COMPANY_NAME   => 'required',
                self::POSITION   => 'required|integer',
                self::START_DATE   => 'required|date',
            );
            $input = Input::only(
                self::COMPANY_NAME,
                self::POSITION,
                self::START_DATE
            );

            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::action('HumanResourcesController@edit', array('id' => $employment))
                    ->withErrors($validator)->withAddNewEmployerHistory(TRUE)->withInput();
            }
            $input[self::STATUS] = BONUSHISTORY;
            $input[self::CREATED_BY] = Auth::admin()->get()->id;
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            $input[self::PERSONAL_ID] = $employment;

            $id = EmploymentHistory::create($input)->id;

        } catch (Exception $e) {

            return $this->returnError($e);
        }

        return Redirect::action('HumanResourcesController@edit', array('id' => $employment));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editHistory($id)
    {
        // dd(1);
        try {
            $company = EmploymentHistory::find($id);
            $industry_category_id = ['Việt Nam', 'Lào ', 'Anh', 'Mỹ'];
            $certificate_category_id = ['Việt Nam', 'Lào ', 'Anh', 'Mỹ'];
        } catch (Exception $e) {

            return $this->returnError($e);
        }
        $result = [
            'company'=>$company,
            self::COMPANY_CATEGORY_ID       =>$this->buildArrayData(Company::orderBy('id', 'asc')->get() ),
            self::BRANCH_ID                 =>$this->buildArrayData(Branch::orderBy('id', 'asc')->get() ),
            self::POSITION_ID               =>$this->buildArrayData(Position::orderBy('id', 'asc')->get() ),
        ];
        return View::make('admin.hr.template.employment_history_edit', $result);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateHistory($employment, $id)
    {
        try {
            $rules = array(
                self::COMPANY_NAME   => 'required',
                // self::BRANCH   => 'required|integer',
                self::POSITION   => 'required|integer',
                self::WHY_OUT   => 'required',
                // self::DESCRIPTION   => 'required',
                self::START_DATE   => 'required|date',
                // self::END_DATE   => 'required|date',
            );
            $input = Input::only(
                self::COMPANY_NAME,
                // self::BRANCH,
                self::POSITION,
                self::WHY_OUT,
                self::DESCRIPTION,
                self::START_DATE,
                self::END_DATE
            );
            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::back()->withErrors($validator);
                return Redirect::action('HumanResourcesController@edit', array('id' => $employment))
                    ->withErrors($validator)->withModel2(TRUE)->withInput();
            }
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;

            $result = EmploymentHistory::where(self::ID, $id)->update($input);
            // dd($result);
        } catch (Exception $e) {
            return $this->returnError($e);
        }

        return Redirect::action('HumanResourcesController@edit', array('id' => $employment));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyHistory($employment, $id)
    {
        try {
            EmploymentHistory::find($id)->delete();
        } catch (Exception $e) {
            return $this->returnError($e);
        }

        return Redirect::action('HumanResourcesController@edit', array('id' => $employment));
    }
    /**
     * change status of history.
     *
     * @param  int  $id
     * @return Response
     */
    public function moveHistory($employment, $id)
    {
        try {
            EmploymentHistory::where(self::ID, $id)->update([self::STATUS=> HISTORY, self::WHY_OUT => self::POSITION_TO_HISTORY, self::DESCRIPTION => self::POSITION_TO_HISTORY]);
        } catch (Exception $e) {
            return $this->returnError($e);
        }

        return Redirect::action('HumanResourcesController@edit', array('id' => $employment));
    }



}
