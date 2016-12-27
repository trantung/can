<?php

class EmploymentEducationalController extends AdminController {

    const ID                = 'id';
    const NAME              = 'name';
    const SCHOOL            = 'school';
    const SCHOOL_NAME       = 'school_name';
    const INDUSTRY          = 'industry_id';
    const CERTIFICATE       = 'certificate_id';
    const GRADUATION_YEAR   = 'graduation_year';
    const PERSONAL_ID       = 'personal_id';
    const CREATED_BY        = 'created_by';
    const UPDATED_BY        = 'updated_by';
    const INDUSTRY_CATEGORY_ID = 'industry_category_id';
    const CERTIFICATE_CATEGORY_ID = 'certificate_category_id';

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeSchool($employment)
    {
        try {
            $rules = array(
                self::SCHOOL_NAME   => 'required',
                self::INDUSTRY   => 'required|integer',
                self::CERTIFICATE   => 'required|integer',
                self::GRADUATION_YEAR   => 'required|date',
            );
            $input = Input::only(
                self::SCHOOL_NAME,
                self::INDUSTRY,
                self::CERTIFICATE,
                self::GRADUATION_YEAR
            );

            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::action('HumanResourcesController@edit', array('id' => $employment))
                    ->withErrors($validator)->withModel1(TRUE)->withInput();
            }
            $input[self::CREATED_BY] = Auth::admin()->get()->id;
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            $input[self::PERSONAL_ID] = $employment;

            $id = EmploymentEducational::create($input)->id;

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
    public function editSchool($id)
    {
        try {
            $result = [
                self::SCHOOL                    =>EmploymentEducational::find($id),
                self::INDUSTRY_CATEGORY_ID      =>$this->buildArrayData(Industry::orderBy('id', 'asc')->get() ),
                self::CERTIFICATE_CATEGORY_ID   =>$this->buildArrayData(Certificate::orderBy('id', 'asc')->get() ),
            ];
            $industry_category_id = ['Việt Nam', 'Lào ', 'Anh', 'Mỹ'];
            $certificate_category_id = ['Việt Nam', 'Lào ', 'Anh', 'Mỹ'];
        } catch (Exception $e) {

            return $this->returnError($e);
        }
        return View::make('admin.hr.template.employment_school_edit', $result);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateSchool($employment, $id)
    {
        try {
            $rules = array(
                self::SCHOOL_NAME   => 'required',
                self::INDUSTRY   => 'required|integer',
                self::CERTIFICATE   => 'required|integer',
                self::GRADUATION_YEAR   => 'required|date',
            );
            $input = Input::only(
                self::SCHOOL_NAME,
                self::INDUSTRY,
                self::CERTIFICATE,
                self::GRADUATION_YEAR,
                self::CREATED_BY,
                self::UPDATED_BY
            );
            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::back()->withErrors($validator);
                return Redirect::action('HumanResourcesController@edit', array('id' => $employment))
                    ->withErrors($validator)->withModel2(TRUE)->withInput();
            }
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;

            $result = EmploymentEducational::where(self::ID, $id)->update($input);
            // dd($result);
        } catch (Exception $e) {
            return $this->returnError($e);
        }

        return Redirect::action('HumanResourcesController@edit', array('id' => $employment));
        // return Redirect::action('HumanResourcesController@index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroySchool($employment, $id)
    {
        try {
            EmploymentEducational::find($id)->delete();
        } catch (Exception $e) {
            return $this->returnError($e);
        }

        return Redirect::action('HumanResourcesController@edit', array('id' => $employment));
    }



}
