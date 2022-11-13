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
Route::group(['prefix' => 'menu_role', 'namespace' => 'App\Modules\MenuRole\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'menu_role.index', 'uses' => 'MenuRoleController@index']);
    Route::get('/getListAjax', ['as' => 'menu_role.getListAjax', 'uses' => 'MenuRoleController@getListAjax']);
    Route::get('/create', ['as' => 'menu_role.create', 'uses' => 'MenuRoleController@create']);
    Route::get('/show/{id}', ['as' => 'menu_role.show', 'uses' => 'MenuRoleController@show']);    
    Route::get('/preview/{id}', ['as' => 'menu_role.preview', 'uses' => 'MenuRoleController@preview']);    
    Route::post('/store', ['as' => 'menu_role.store', 'uses' => 'MenuRoleController@store']);
    Route::get('/edit/{id}', ['as' => 'menu_role.edit', 'uses' => 'MenuRoleController@edit']);
    Route::put('/update/{id}', ['as' => 'menu_role.update', 'uses' => 'MenuRoleController@update']);
    Route::delete('/delete/{id}', ['as' => 'menu_role.destroy', 'uses' => 'MenuRoleController@destroy']);

    Route::post('/updateField', ['as' => 'menu_role.updateField', 'uses' => 'MenuRoleController@updateField']);
});