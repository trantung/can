<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
// App::missing(function($exception)
// {
//     $segment = Request::segment(1);
//     dd($segment);

//     // if(Request::segment(3) && strpos(Request::url(), '/games/')){
//     //     $errorType = ERROR_TYPE_MISSING;
//     // } else {
//     //     $errorType = ERROR_TYPE_404;
//     // }
//     // // Log::error( Request::url() );
//     // return CommonLog::logErrors($errorType);
// });

// App::error(function(Exception $exception)
// {
    
//     return Redirect::action('AdminController@login');
// });

Route::get('/insert-permission', function(){
    $array = [
        'Quản lý nhóm khách hàng' => "CustomerGroupController",
        'Quản lý khách hàng' => "ConfigCustomerController",
        'Quản lý đối tác' => "ManagePartnerController",
        'Quản lý nhóm đối tác' =>"PartnerController",
        'Danh sách thành phẩm' =>"ProductController",
        'Cấu hình sản phẩm' =>"ProductManagerController",
        'Tự sản xuất' =>"ProductionAutoController",
        'Danh sách nguyên liệu' =>"ProductCategoryController",
        'Quản lý trạm cân, thống kê cân lẻ/chiến dịch, in chứng thư' =>"ScaleStationController",
        'Hao hụt lưu kho' =>"StorageLossController",
        'Danh sách kho' =>"WarehouseController",
    ];
    $array1 = [
        '__construct',
        'login',
        'doLogin',
        'logout',
        'beforeFilter',
        'afterFilter',
        'forgetBeforeFilter',
        'forgetAfterFilter',
        'getBeforeFilters',
        'getAfterFilters',
        'getFilterer',
        'setFilterer',
        'callAction',
        'missingMethod',
        '__call'
    ];
    // $ob = get_class_methods('CustomerGroupController');
    // $arrayDiff = array_diff($ob, $array1);
    // dd($arrayDiff);
    // $string = implode(',', $arrayDiff);
    // dd(implode(',', $ob));
    // dd(get_class_methods('ScaleStationController'));
    foreach ($array as $key => $value) {
        $listMethodClass = get_class_methods($value);
        $arrayDiff = array_diff($listMethodClass, $array1);
        // dd($arrayDiff);
        $string = implode(',', $arrayDiff);
        Permission::create([
            'name' => $key,
            'module_id' => 8,
            'controller_action' => $value,
            'action' => $string,
        ]);
    }
dd(1);
    // $ob = files('hr');
    $path = app_path();
    // $controllers = $path[4];
    // dd($path);
    $files = scandir($path.'/controllers/admin');
    unset($files[0]);
    unset($files[1]);
    unset($files[29]);
    dd($files);


    $company = Company::find(33);
    dd(getChild($company));
    dd(Admin::isHr());
    // Admin::whereNull('permission_id')->update(['permission_id' =>1]);
    $string = 'abcd';
    dd($string[0]);
    dd(substr('abcdef', 1));
} );
Route::post('/testshipchung', function(){
    $input = Input::all();
    // dd($input);
    // {"TrackingCode":"SC596073702",
    // "StatusId":"16","StatusName":"\u0110\u00e3 l\u1ea5y h\u00e0ng","TimeStamp":1505576172610}
    $inputAll = json_encode($input);
    $ship['tracking_code'] = $input['TrackingCode'];
    $ship['status_id'] = $input['StatusId'];
    $ship['status_name'] = $input['StatusName'];
    $ship['time'] = $input['TimeStamp'];
    $ship['log'] = $inputAll;
    DB::table('shipchung')->insert($ship);
});
Route::get('/fixdatabase', function(){
    CustomerShip::whereNull('customer_id')->delete();
    CustomerShip::whereNull('customer_name')->delete();
    CustomerShip::where('customer_id', '')->delete();
    CustomerShip::where('customer_name', '')->delete();
    $customers = CustomerShip::distinct('customer_id')->lists('customer_id');
    // dd($customers);
    foreach ($customers as $key => $value) {
        $ob = CustomerShip::where('customer_id', $value)->first();
        if ($ob) {
            $arr[] = $ob->id;
        }
    }
    CustomerShip::whereNotIn('id', $arr)->delete();
    dd('ok');

} );

Route::group(['prefix' => 'admin'], function () {

    Route::get('chart', function(){
        return View::make('admin.chart.bar');
    });

	Route::get('/login', array('uses' => 'AdminController@login', 'as' => 'admin.login'));
	Route::post('/login', array('uses' => 'AdminController@doLogin'));
    Route::get('/logout', array('uses' => 'AdminController@logout', 'as' => 'admin.logout'));
	Route::get('/dashboard', array('uses' => 'AdminController@dashboard'));
	// Route::resource('/', 'AdminController');

	Route::get('/manager/changepassword/{id}', array('uses' => 'ManagerController@changePassword', 'as' => 'admin.manager.chanpassword'));
	Route::post('/manager/updatePassword/{id}', array('uses' => 'ManagerController@updatePassword'));
	Route::get('/manager/search', array('uses' => 'ManagerController@search', 'as' => 'admin.manager.search'));
	Route::resource('/manager', 'ManagerController');
    Route::get('/hr/{id}/edit', array('uses' => 'HumanResourcesController@edit', 'as' => 'hr.edit'));
    Route::resource('/hr', 'HumanResourcesController');
    Route::resource('/branch', 'BranchCategoryController');
    Route::get('/position-with-branch-id', 'PositionCategoryController@getPositionWithBranch');
    Route::resource('/position', 'PositionCategoryController');
    Route::resource('/contract', 'ContractCategoryController');
    Route::resource('/religion', 'ReligionCategoryController');
    Route::resource('/employees', 'EmployeesCategoryController');
    Route::resource('/ethnic', 'EthnicCategoryController');
    Route::resource('/company', 'CompanyCategoryController');
    Route::resource('/nationality', 'NationalityCategoryController');//
    Route::resource('/industry', 'IndustryCategoryController');//
    Route::resource('/certificate', 'CertificateCategoryController');//
    Route::resource('/department', 'DepartmentCategoryController');//
    Route::resource('/officer', 'OfficerCategoryController');//
    Route::resource('/bonus-category', 'BonusCategoryController');//
    Route::resource('/bank-category', 'BankCategoryController');//
    Route::resource('/currency-category', 'CurrencyCategoryController');//
    Route::resource('/product-category', 'ProductCategoryController');
    Route::resource('/product', 'ProductController');
    Route::resource('/production-loss', 'ProductionLossController');

    Route::post('/storage-loss/reset/{id}', array('uses' => 'StorageLossController@reset'));
    Route::get('/storage-loss/search', 'StorageLossController@search');
    Route::get('/storage-loss/cancel/search', 'StorageLossController@cancelSearch');
    Route::resource('/storage-loss', 'StorageLossController');

    Route::resource('/overload-ratio', 'OverloadRatioController');
    Route::get('/scale-station/export-excel-campaign', array('uses' => 'ScaleStationController@exportExcel'));
    Route::get('/scale-station/export-excel-odd', array('uses' => 'ScaleStationController@exportExcelOdd'));
    Route::get('/scale-station/export-excel-campaign-detail/{campaignCode}', array('uses' => 'ScaleStationController@exportExcelDetailCampaign'));
    Route::get('/scale-station/detail/{id}', array('uses' => 'ScaleStationController@showDetail'));
    Route::get('/scale-station/get-detail/{id}', array('uses' => 'ScaleStationController@getDetail'));
    Route::get('/scale-station-campaign-detail/search', 'ScaleStationController@searchDetailCampaign');
    Route::resource('/scale-station', 'ScaleStationController', array('except' => array('show')));
    Route::controller('/scale-station', 'ScaleStationController');
    Route::resource('/customer-group', 'CustomerGroupController');
    Route::resource('/partner-group', 'PartnerGroupController');
    Route::controller('/scale-manage', 'ScaleManageController');
    // Route::post('/vocabulary', 'Admin2Controller@store');
    Route::get('/jstree', array('uses' => 'CompanyCategoryController@buildCateJsTree'));
    Route::get('/combotree', array('uses' => 'CompanyCategoryController@buildCate'));
    Route::post('/list-department', array('uses' => 'CompanyCategoryController@getDepartment'));


    Route::resource('/salaries', 'SalariesController');
    Route::resource('/job-industry', 'JobIndustryCategoryController');
    Route::resource('/insurance', 'InsuranceController');
    Route::resource('/salaries-category', 'SalariesCategoryController');

    Route::post('/{employment}/employment-education', array('uses' => 'EmploymentEducationalController@storeSchool', 'as' => 'employment.newEducation'));
    Route::put('/{employment}/employment-education/{id}', 'EmploymentEducationalController@updateSchool');
    Route::delete('/{employment}/employment-education/{id}', array('uses' => 'EmploymentEducationalController@destroySchool', 'as' => 'employment.destroy'));
    Route::get('/employment-education/{id}/edit', array('uses' => 'EmploymentEducationalController@editSchool', 'as' => 'employment.edit'));


     Route::post('/{employment}/employment-history', array('uses' => 'EmploymentHistoryController@storeHistory', 'as' => 'employment.newHistory'));
    Route::put('/{employment}/employment-history/{id}', 'EmploymentHistoryController@updateHistory');
    Route::put('/{employment}/employment-position-history/{id}', 'EmploymentHistoryController@updatePsHistory');
    Route::delete('/{employment}/employment-history/{id}', array('uses' => 'EmploymentHistoryController@destroyHistory', 'as' => 'employment.destroyHistory'));
    Route::get('/employment-history/{id}/edit', array('uses' => 'EmploymentHistoryController@editHistory', 'as' => 'employment.editHistory'));

    Route::get('/employment-position-history/{id}/edit', array('uses' => 'EmploymentHistoryController@editPositionHistory', 'as' => 'employment.editPositionHistory'));

    Route::post('/{employment}/employment-files', array('uses' => 'EmploymentFilesController@storeFile', 'as' => 'employment.newFiles'));
    Route::delete('/{employment}/employment-files/{id}', array('uses' => 'EmploymentFilesController@destroyFile', 'as' => 'employment.destroyFile'));

    Route::post('/{employment}/employment-bonus-history', array('uses' => 'EmploymentBonusHistoryController@storeBonusHistory', 'as' => 'employment.newBonusHistory'));
    Route::delete('/{employment}/employment-bonus-history/{id}', array('uses' => 'EmploymentBonusHistoryController@destroyBonusHistory', 'as' => 'employment.destroyBonusHistory'));

    Route::post('/{employment}/employment-position', array('uses' => 'EmploymentHistoryController@newPosition', 'as' => 'employment.newPosition'));
    Route::delete('/{employment}/employment-position/{id}', array('uses' => 'EmploymentHistoryController@moveHistory', 'as' => 'employment.moveHistory'));
    Route::get('/{employment}/employment-position-main/{id}', array('uses' => 'EmploymentHistoryController@mainPosition', 'as' => 'hr.is_main_position'));
    Route::get('/statistics/insurance', array('uses' => 'InsuranceController@statistics', 'as' => 'hr.statistics.insurance'));
    Route::get('/statistics/insurance-detail/{user_id}', array('uses' => 'InsuranceController@detailSearch', 'as' => 'hr.statistics-detail.insurance'));
    Route::get('/statistics/birthday', array('uses' => 'HumanResourcesController@birthdaySearch', 'as' => 'hr.statistics.birthday'));

    // tantan add chart
    Route::get('/statistic/chart/search', ['uses' => 'StatisticsChartController@search', 'as' => 'ChartFilter']);
    Route::resource('/statistic/chart', 'StatisticsChartController');

    Route::get('/nhap-luong/{object_id}', 'EmploymentHistoryController@buildCompanyText');
    Route::group(['prefix' => 'permission'], function(){
        Route::get('/setup/role/', 'PermissionController@createRole');
        Route::get('/setup/role/{id}', 'PermissionController@editRole');
        Route::post('/setup/role/{id}', 'PermissionController@updateRole');
        Route::post('/setup/user', 'PermissionController@storeUser');

        Route::get('/setup/user', 'PermissionController@createUser');
        Route::get('/setup/user/{id}', 'PermissionController@editUser');
        Route::post('/setup/user/{id}', 'PermissionController@updateUser');
        Route::get('/setup/list-user', 'PermissionController@indexUser');
        Route::resource('/setup', 'PermissionController');//
        //create, view, edit, view_list, delete by user, delete by root-->permission admin
        Route::resource('/system', 'SystemController');

        //CRUD --> có 4 quyền cho user(QLNS)
        Route::resource('/user', 'UserSystemController');

        //CRUD-->có 4 quyền cho lịch sử công tác
        Route::resource('/log/user', 'UserHistoryController');

        //CRUD
        Route::resource('/config/user', 'UserConfigController');


        // có 2 quyền salary: nhập lương = tay và nhập lương = import excel
        Route::resource('/salary', 'SalaryConfigController');
    });
    Route::resource('/config-permission', 'ConfigPermissionController');
    Route::resource('/config-user', 'ConfigUserController');
    Route::resource('/config-customer', 'ConfigCustomerController');
    Route::resource('/partner', 'PartnerController');
    Route::resource('/manage-partner', 'ManagePartnerController');
    Route::resource('/config-partner', 'ConfigPartnerController');
    Route::resource('/product-manage', 'ProductManagerController');
    Route::get('/warehouse/search', 'WarehouseController@search');
    Route::resource('/warehouse', 'WarehouseController', array('except' => array('show')));
    Route::controller('/warehouse', 'WarehouseController');
    Route::resource('/production-auto', 'ProductionAutoController', array('except' => array('show')));
    Route::controller('/production-auto', 'ProductionAutoController');
    Route::resource('config-property', 'ConfigPropertyController', array('except' => array('show')));
    Route::controller('/config-property', 'ConfigPropertyController');
    // Route::put('/config-user/update/{id}', 'ConfigUserController@update');

    Route::resource('/thongke/scale', 'ThongkeScaleController');

    Route::group(['prefix' => 'api'], function(){
        Route::get('/department-by-one/{id}', 'CompanyCategoryController@getDepartmentByOne');
        Route::get('/warehouse-by-department/{id}', 'WarehouseController@getWarehouseByDepartment');
        Route::get('/warehouse', 'WarehouseController@getWarehouse');

        //copy
    });
});
Route::get('/login', array('uses' => 'AdminController@login', 'as' => 'admin.login'));

Route::group(['prefix' => 'api'], function () {
    Route::post('/install/kcs/{appId}/{chinhanhCode}', 'ApiController@installKcs');
    Route::controller('/request', 'ApiController');
    Route::post('/importcan', 'ApiImportManagement@importBangCan');
    Route::post('/importkiemdinh', 'ApiImportManagement@importKiemDinh');
    Route::post('/importkhachhang', 'ApiImportManagement@importKhachHang');
    Route::post('/import', 'ApiImportManagement@store');
    Route::post('/changepassword', 'ApiImportManagement@changePassword');
    Route::post('/gettype', 'ApiImportManagement@getTheLoai');
    Route::post('/getthanhpham', 'ApiImportManagement@getThanhPham');

});
