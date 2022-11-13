<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['prefix' => 'staff', 'namespace' => 'App\Modules\Staff\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'staff.index', 'uses' => 'StaffController@index']);
    Route::get('/getListAjax', ['as' => 'staff.getListAjax', 'uses' => 'StaffController@getListAjax']);
    Route::get('/getListAjaxPeoples', ['as' => 'staff.getListAjaxPeoples', 'uses' => 'StaffController@getListAjaxPeoples']);
    Route::get('/getListAjaxByStructureId/{structure}', ['as' => 'staff.getListAjaxByStructureId', 'uses' => 'StaffController@getListAjaxByStructureId']);
    
    Route::get('/create', ['as' => 'staff.create', 'uses' => 'StaffController@create']);
    Route::get('/show/{id}', ['as' => 'staff.show', 'uses' => 'StaffController@show']);    
    Route::get('/preview/{id}', ['as' => 'staff.preview', 'uses' => 'StaffController@preview']);    
    Route::post('/store', ['as' => 'staff.store', 'uses' => 'StaffController@store']);
    Route::get('/staff', ['as' => 'staff.staff', 'uses' => 'StaffController@staff']);
    Route::get('/edit/{id}', ['as' => 'staff.edit', 'uses' => 'StaffController@edit']);
    Route::put('/update/{id}', ['as' => 'staff.update', 'uses' => 'StaffController@update']);
    Route::delete('/delete/{id}', ['as' => 'staff.destroy', 'uses' => 'StaffController@destroy']);
});