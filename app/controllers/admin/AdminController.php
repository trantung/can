<?php
class AdminController extends BaseController {
    public function __construct() {
        $this->beforeFilter('admin', array('except'=>array('login','doLogin')));
        // $this->beforeFilter('checkPermission', array('except'=>array('login','doLogin','logout')));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   // public function checkPermission()
   //  {
   //      $userid = Auth::admin()->get()->id;
   //      $listRole = RoleUser::where('user_id', $userid)->lists('role_id');
   //      $listPermission = RolePermission::whereIn('role_id', $listRole)->lists('permission_id');
   //      $listPermissionPrivate = PermissionUser::where('user_id', $userid)->lists('permission_id');
   //      $approvePermission = array_merge($listPermission, $listPermissionPrivate);
   //      $permissions = Permission::whereIn('id', $approvePermission)->lists('controller_action', 'action');
   //      $route = Route::getCurrentRoute()->getActionName();
   //      $controller_action = explode('@', $route)[0];
   //      $action = explode('@', $route)[1];
   //      $listController = array_values($permissions);
   //      $listAction = array_keys($permissions);
   //      if (!in_array($controller_action, $listController)) {
   //          dd('Khong co quyen');
   //      }
   //      $test = implode(',', $listAction);
   //      $arrTest = explode(',', $test);
   //      if (!in_array($action, $arrTest)) {
   //          return 'sai cmnr';
   //      }

   //  }

    public function index()
    {
        $checkLogin = Auth::admin()->check();
        if($checkLogin) {
            return Redirect::action('ManagerController@index', Auth::admin()->get()->id);
        } else {
            return View::make('admin.layout.login');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
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
        //
    }
    public function login()
    {
        $checkLogin = Auth::admin()->check();
        if($checkLogin) {
            if (Auth::admin()->get()->status == ACTIVE) {
                return Redirect::action('ManagerController@edit', Auth::admin()->get()->id);
            }else{
                return View::make('admin.layout.login')->with(compact('message','chưa kich hoat'));
            }
        } else {
            return View::make('admin.layout.login');
        }
    }
    public function doLogin()
    {
        try {
            $rules = array(
                'username'   => 'required',
                'password'   => 'required',
            );
            $input = Input::except('_token');
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return Redirect::route('admin.login')
                    ->withErrors($validator)
                    ->withInput(Input::except('password'));
            } else {
                $checkLogin = Auth::admin()->attempt($input);
                if($checkLogin) {
                    return Redirect::action('HumanResourcesController@index');
                } else {
                    return Redirect::route('admin.login');
                }
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function logout()
    {
        Auth::admin()->logout();
        Session::flush();
        return Redirect::route('admin.login');
    }

    protected function appendSpaceAfterName($value)
    {
        if($value->level > 1){
            $value->level = $value->level - 1;
            $value->name = '- '.$value->name;

            return $this->appendSpaceAfterName($value);
        }

        return $value->name;
    }

    protected function buildTree($items)
    {
        $map = array(
            0 => array('childs' => array())
        );

        foreach ($items as &$item) {
            $item['childs'] = array();
            $map[$item['id']] = &$item;
        }

        foreach ($items as &$item) {
            $map[$item['parent_id']]['childs'][] = &$item;
        }

        return $map[0]['childs'];
    }


    protected function buildArrayData($data, $subTable = null)
    {
        $result = [];

        if ($data->count() == 0) {
           return  $result;
        }

        // if ($subTable) {
        //     // $data = $this->buildTree($data);
        //     // dd($data);
        //     foreach ($data as $key => $value) {
        //     // dd($value);
        //        if($value->level > 0){
        //             $result[$value->id] =  $this->appendSpaceAfterName($value);
        //        }else {
        //             $result[$value->id] = $value->name;
        //        }
        //     }
        //     // dd($result);
        // }else{
            // dd($data->toArray());
            foreach ($data as $key => $value) {
                if ($subTable) {
                    $result[$value->$subTable] = $value->name;
                }else{
                    $result[$value->id] = $value->name;
                }
            }
        // }


        // foreach ($data as $key => $value) {
        //    if($subTable){
        //     $result[$value->name] =  $this->buildArrayData($value->$subTable);
        //    }else {

        //     $result[$value->id] = $value->name;
        //    }
        // }

        // dd($result);

        return $result;
    }


}

