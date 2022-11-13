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
Route::group(['prefix' => 'asset_status', 'namespace' => 'App\Modules\AssetStatus\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'asset_status.index', 'uses' => 'AssetStatusController@index']);
    Route::get('/getListAjax', ['as' => 'asset_status.getListAjax', 'uses' => 'AssetStatusController@getListAjax']);
    Route::get('/create', ['as' => 'asset_status.create', 'uses' => 'AssetStatusController@create']);
    Route::get('/show/{id}', ['as' => 'asset_status.show', 'uses' => 'AssetStatusController@show']);    
    Route::get('/preview/{id}', ['as' => 'asset_status.preview', 'uses' => 'AssetStatusController@preview']);    
    Route::post('/store', ['as' => 'asset_status.store', 'uses' => 'AssetStatusController@store']);
    Route::get('/edit/{id}', ['as' => 'asset_status.edit', 'uses' => 'AssetStatusController@edit']);
    Route::put('/update/{id}', ['as' => 'asset_status.update', 'uses' => 'AssetStatusController@update']);
    Route::delete('/delete/{id}', ['as' => 'asset_status.destroy', 'uses' => 'AssetStatusController@destroy']);
});