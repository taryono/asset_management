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
Route::group(['prefix' => 'department', 'namespace' => 'App\Modules\Department\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'department.index', 'uses' => 'DepartmentController@index']);
    Route::get('/getListAjax', ['as' => 'department.getListAjax', 'uses' => 'DepartmentController@getListAjax']);
    Route::get('/create', ['as' => 'department.create', 'uses' => 'DepartmentController@create']);
    Route::get('/show/{id}', ['as' => 'department.show', 'uses' => 'DepartmentController@show']);    
    Route::get('/preview/{id}', ['as' => 'department.preview', 'uses' => 'DepartmentController@preview']);    
    Route::post('/store', ['as' => 'department.store', 'uses' => 'DepartmentController@store']);
    Route::get('/edit/{id}', ['as' => 'department.edit', 'uses' => 'DepartmentController@edit']);
    Route::put('/update/{id}', ['as' => 'department.update', 'uses' => 'DepartmentController@update']);
    Route::delete('/delete/{id}', ['as' => 'department.destroy', 'uses' => 'DepartmentController@destroy']);
});