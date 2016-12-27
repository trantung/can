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

Route::group(['prefix' => 'admin'], function () {

	Route::get('/login', array('uses' => 'AdminController@login', 'as' => 'admin.login'));
	Route::post('/login', array('uses' => 'AdminController@doLogin'));
	Route::get('/logout', array('uses' => 'AdminController@logout', 'as' => 'admin.logout'));
	Route::resource('/', 'AdminController');

	Route::get('/manager/changepassword/{id}', array('uses' => 'ManagerController@changePassword', 'as' => 'admin.manager.chanpassword'));
	Route::post('/manager/updatePassword/{id}', array('uses' => 'ManagerController@updatePassword'));
	Route::get('/manager/search', array('uses' => 'ManagerController@search', 'as' => 'admin.manager.search'));
	Route::resource('/manager', 'ManagerController');
    Route::get('/hr/{id}/edit', array('uses' => 'HumanResourcesController@edit', 'as' => 'hr.edit'));
    Route::resource('/hr', 'HumanResourcesController');
    Route::resource('/branch', 'BranchCategoryController');
    Route::resource('/position', 'PositionCategoryController');
    Route::resource('/contract', 'ContractCategoryController');
    Route::resource('/religion', 'ReligionCategoryController');
    Route::resource('/employees', 'EmployeesCategoryController');
    Route::resource('/ethnic', 'EthnicCategoryController');
    Route::resource('/company', 'CompanyCategoryController');
    Route::resource('/nationality', 'NationalityCategoryController');//
    Route::resource('/industry', 'IndustryCategoryController');//
    Route::resource('/certificate', 'CertificateCategoryController');//

    //
    Route::post('/{employment}/employment-education', array('uses' => 'EmploymentEducationalController@storeSchool', 'as' => 'employment.newEducation'));
    Route::put('/{employment}/employment-education/{id}', 'EmploymentEducationalController@updateSchool');
    Route::delete('/{employment}/employment-education/{id}', array('uses' => 'EmploymentEducationalController@destroySchool', 'as' => 'employment.destroy'));
    Route::get('/employment-education/{id}/edit', array('uses' => 'EmploymentEducationalController@editSchool', 'as' => 'employment.edit'));


     Route::post('/{employment}/employment-history', array('uses' => 'EmploymentHistoryController@storeHistory', 'as' => 'employment.newHistory'));
    Route::put('/{employment}/employment-history/{id}', 'EmploymentHistoryController@updateHistory');
    Route::delete('/{employment}/employment-history/{id}', array('uses' => 'EmploymentHistoryController@destroyHistory', 'as' => 'employment.destroyHistory'));
    Route::get('/employment-history/{id}/edit', array('uses' => 'EmploymentHistoryController@editHistory', 'as' => 'employment.editHistory'));

});

