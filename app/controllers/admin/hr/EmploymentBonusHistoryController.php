<?php

class EmploymentBonusHistoryController extends AdminController {

    const ID                = 'id';
    const NAME              = 'name';
    const WHY_BONUS         = 'why_bonus';
    const DATE              = 'date';
    const DESCRIPTION       = 'description';
    const PERSONAL_ID       = 'personal_id';
    const CREATED_BY        = 'created_by';
    const UPDATED_BY        = 'updated_by';

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeBonusHistory($employment)
    {
        try {
            $rules = array(
                self::WHY_BONUS   => 'required',
                self::DESCRIPTION   => 'required',
                self::DATE   => 'required|date',
            );
            $input = Input::only(
                self::WHY_BONUS,
                self::DATE,
                self::DESCRIPTION
            );

            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::action('HumanResourcesController@edit', array('id' => $employment))
                    ->withErrors($validator)->withAddNewEmployerBonusHistory(TRUE)->withInput();
            }
            $input[self::CREATED_BY] = Auth::admin()->get()->id;
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            $input[self::PERSONAL_ID] = $employment;

            $id = BonusHistory::create($input)->id;

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

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateSchool($employment, $id)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyBonusHistory($employment, $id)
    {
        try {
            BonusHistory::find($id)->delete();
        } catch (Exception $e) {
            return $this->returnError($e);
        }

        return Redirect::action('HumanResourcesController@edit', array('id' => $employment));
    }



}
