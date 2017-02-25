<?php

class EmploymentFilesController extends AdminController {

    const ID                = 'id';
    const NAME              = 'name';
    const LINK_NAME              = 'file_name';
    const LINK              = 'link';
    const DESCRIPTION              = 'description';
    const FILE              = 'file';
    const PERSONAL_ID       = 'personal_id';
    const CREATED_BY        = 'created_by';
    const UPDATED_BY        = 'updated_by';

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeFile($employment)
    {
        try {
            $rules = array(
                self::LINK_NAME   => 'required',
            );
            $input = Input::only(
                self::LINK_NAME,
                self::DESCRIPTION,
                self::FILE
            );
            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::action('HumanResourcesController@edit', array('id' => $employment))
                    ->withErrors($validator)->withAddNewEmployerFile(TRUE)->withInput();
            }
            $input[self::LINK] = CommonUpload::uploadImage($employment, UPLOADFILE, self::FILE, UPLOAD_FILE);
            $input[self::CREATED_BY] = Auth::admin()->get()->id;
            $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            $input[self::PERSONAL_ID] = $employment;
            $input[self::NAME] = $input[self::LINK_NAME];


            $id = Files::create($input)->id;

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
    public function destroyFile($employment, $id)
    {
        try {
            Files::find($id)->delete();
        } catch (Exception $e) {
            return $this->returnError($e);
        }

        return Redirect::action('HumanResourcesController@edit', array('id' => $employment));
    }



}
