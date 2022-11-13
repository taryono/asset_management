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
Route::group(['prefix' => 'role', 'namespace' => 'App\Modules\Role\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'role.index', 'uses' => 'RoleController@index']);
    Route::get('/getListAjax', ['as' => 'role.getListAjax', 'uses' => 'RoleController@getListAjax']);
    Route::get('/getMenuRoleListAjax/{role_id}', ['as' => 'role.getMenuRoleListAjax', 'uses' => 'RoleController@getMenuRoleListAjax']);
    Route::get('/create', ['as' => 'role.create', 'uses' => 'RoleController@create']);
    Route::get('/show/{id}', ['as' => 'role.show', 'uses' => 'RoleController@show']);    
    Route::get('/preview/{id}', ['as' => 'role.preview', 'uses' => 'RoleController@preview']);    
    Route::post('/store', ['as' => 'role.store', 'uses' => 'RoleController@store']);
    Route::get('/edit/{id}', ['as' => 'role.edit', 'uses' => 'RoleController@edit']);
    Route::put('/update/{id}', ['as' => 'role.update', 'uses' => 'RoleController@update']);
    Route::delete('/delete/{id}', ['as' => 'role.destroy', 'uses' => 'RoleController@destroy']);
});