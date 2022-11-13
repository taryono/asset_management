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
Route::group(['prefix' => 'admin', 'namespace' => 'App\Modules\Admin\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
    Route::get('/settings', ['as' => 'admin.settings', 'uses' => 'AdminController@settings']);
    Route::get('/getListAjax', ['as' => 'admin.getListAjax', 'uses' => 'AdminController@getListAjax']);
    Route::get('/create', ['as' => 'admin.create', 'uses' => 'AdminController@create']);
    Route::get('/pages', ['as' => 'admin.pages', 'uses' => 'AdminController@pages']);
    
    Route::get('/change_password', ['as' => 'admin.change_password', 'uses' => 'AdminController@change_password']);
    Route::get('/show/{id}', ['as' => 'admin.show', 'uses' => 'AdminController@show']);    
    Route::get('/preview/{id}', ['as' => 'admin.preview', 'uses' => 'AdminController@preview']);    
    Route::post('/store', ['as' => 'admin.store', 'uses' => 'AdminController@store']);
    Route::get('/edit/{id}', ['as' => 'admin.edit', 'uses' => 'AdminController@edit']);
    Route::put('/update/{id}', ['as' => 'admin.update', 'uses' => 'AdminController@update']);
    Route::delete('/delete/{id}', ['as' => 'admin.destroy', 'uses' => 'AdminController@destroy']);

    Route::get('/date_range', ['as' => 'admin.date_range', 'uses' => 'AdminController@date_range']);    
});