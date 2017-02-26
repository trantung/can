<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});

Route::filter('admin', function()
{
	if (Auth::admin()->guest()){
		return Redirect::route('admin.login');
	}
});

Route::filter('checkPermission', function()
{
	$userid = Auth::admin()->get()->id;
    $listRole = RoleUser::where('user_id', $userid)->lists('role_id');
    $listPermission = RolePermission::whereIn('role_id', $listRole)->lists('permission_id');
    $listPermissionPrivate = PermissionUser::where('user_id', $userid)->lists('permission_id');
    $approvePermission = array_merge($listPermission, $listPermissionPrivate);
    $permissions = Permission::whereIn('id', $approvePermission)->get();
			$list = '';
	foreach ($permissions as $key => $value) {
		$previous = $key - 1;
		$data[$key] = new stdClass();
		$data[$key] = $value;
		if (isset($data[$previous])) {
			if ($value->controller_action == $data[$previous]['controller_action']) {
    			$list .= $value->action .',';
				$arrayPermission[$value->controller_action] = $list;
    		}
		}
		
	}
    $route = Route::getCurrentRoute()->getActionName();
    $controller_action = explode('@', $route)[0];
    $action = explode('@', $route)[1];
	if (!isset($arrayPermission[$controller_action])) {
		dd('Khong co quyen');
	}
	$arrPer = explode(',', $arrayPermission[$controller_action]);
	if (!in_array($action, $arrPer)) {
        dd('Khong co quyen');
    }
	// dd($ab2);
 //    $listController = array_values($permissions);
 //    $listAction = array_keys($permissions);

 //    if (!in_array($controller_action, $listController)) {
 //        dd('Khong co quyen');
 //    }
 //    $test = implode(',', $listAction);
 //    $arrTest = explode(',', $test);
 //    if (!in_array($action, $arrTest)) {
 //        return 'sai cmnr';
 //    }
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
