<?php

class Admin2Controller extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // return View::make('admin.manager.create');
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
            'name'=>'required',
            );

            $input = Input::only('name');
            $validator =  Validator::make($input,$rules);
            if($validator->fails()) {
                return Redirect::action('Devfactory\Taxonomy\Controllers\TaxonomyController@index')
                    ->withErrors($validator);
            }

            $id = \Taxonomy::createVocabulary($input['name']);
            if(!$id) {
                dd('Error');
            }

        } catch (Exception $e) {

            return $this->returnError($e);
        }
        return Redirect::action('Devfactory\Taxonomy\Controllers\TaxonomyController@index');
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

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }


}
