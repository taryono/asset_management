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
Route::group(['prefix' => 'asset_request', 'namespace' => 'App\Modules\AssetRequest\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'asset_request.index', 'uses' => 'AssetRequestController@index']);
    Route::get('/getListAjax', ['as' => 'asset_request.getListAjax', 'uses' => 'AssetRequestController@getListAjax']);
    Route::get('/create', ['as' => 'asset_request.create', 'uses' => 'AssetRequestController@create']);
    Route::get('/show/{id}', ['as' => 'asset_request.show', 'uses' => 'AssetRequestController@show']);    
    Route::get('/preview/{id}', ['as' => 'asset_request.preview', 'uses' => 'AssetRequestController@preview']);    
    Route::post('/store', ['as' => 'asset_request.store', 'uses' => 'AssetRequestController@store']);
    Route::get('/edit/{id}', ['as' => 'asset_request.edit', 'uses' => 'AssetRequestController@edit']);
    Route::put('/update/{id}', ['as' => 'asset_request.update', 'uses' => 'AssetRequestController@update']);
    Route::delete('/delete/{id}', ['as' => 'asset_request.destroy', 'uses' => 'AssetRequestController@destroy']);
});