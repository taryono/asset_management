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
Route::group(['prefix' => 'asset', 'namespace' => 'App\Modules\Asset\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'asset.index', 'uses' => 'AssetController@index']);
    Route::get('/getListAjax', ['as' => 'asset.getListAjax', 'uses' => 'AssetController@getListAjax']);
    Route::get('/create', ['as' => 'asset.create', 'uses' => 'AssetController@create']);
    Route::get('/show/{id}', ['as' => 'asset.show', 'uses' => 'AssetController@show']);    
    Route::get('/preview/{id}', ['as' => 'asset.preview', 'uses' => 'AssetController@preview']);    
    Route::post('/store', ['as' => 'asset.store', 'uses' => 'AssetController@store']);
    Route::get('/edit/{id}', ['as' => 'asset.edit', 'uses' => 'AssetController@edit']);
    Route::put('/update/{id}', ['as' => 'asset.update', 'uses' => 'AssetController@update']);
    Route::delete('/delete/{id}', ['as' => 'asset.destroy', 'uses' => 'AssetController@destroy']);
});