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
Route::group(['prefix' => 'controller', 'namespace' => 'App\Modules\Controller\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'controller.index', 'uses' => 'ControllerController@index']);
    Route::get('/getListAjax', ['as' => 'controller.getListAjax', 'uses' => 'ControllerController@getListAjax']);
    Route::get('/create', ['as' => 'controller.create', 'uses' => 'ControllerController@create']);
    Route::get('/show/{id}', ['as' => 'controller.show', 'uses' => 'ControllerController@show']);    
    Route::get('/preview/{id}', ['as' => 'controller.preview', 'uses' => 'ControllerController@preview']);    
    Route::post('/store', ['as' => 'controller.store', 'uses' => 'ControllerController@store']);
    Route::get('/edit/{id}', ['as' => 'controller.edit', 'uses' => 'ControllerController@edit']);
    Route::put('/update/{id}', ['as' => 'controller.update', 'uses' => 'ControllerController@update']);
    Route::delete('/delete/{id}', ['as' => 'controller.destroy', 'uses' => 'ControllerController@destroy']);
});