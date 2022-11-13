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
Route::group(['prefix' => 'group_menu', 'namespace' => 'App\Modules\GroupMenu\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'group_menu.index', 'uses' => 'GroupMenuController@index']);
    Route::get('/getListAjax', ['as' => 'group_menu.getListAjax', 'uses' => 'GroupMenuController@getListAjax']);
    Route::get('/create', ['as' => 'group_menu.create', 'uses' => 'GroupMenuController@create']);
    Route::get('/show/{id}', ['as' => 'group_menu.show', 'uses' => 'GroupMenuController@show']);    
    Route::get('/preview/{id}', ['as' => 'group_menu.preview', 'uses' => 'GroupMenuController@preview']);    
    Route::post('/store', ['as' => 'group_menu.store', 'uses' => 'GroupMenuController@store']);
    Route::get('/edit/{id}', ['as' => 'group_menu.edit', 'uses' => 'GroupMenuController@edit']);
    Route::put('/update/{id}', ['as' => 'group_menu.update', 'uses' => 'GroupMenuController@update']);
    Route::delete('/delete/{id}', ['as' => 'group_menu.destroy', 'uses' => 'GroupMenuController@destroy']);
});