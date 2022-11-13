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
Route::group(['prefix' => 'asset_category', 'namespace' => 'App\Modules\AssetCategory\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'asset_category.index', 'uses' => 'AssetCategoryController@index']);
    Route::get('/getListAjax', ['as' => 'asset_category.getListAjax', 'uses' => 'AssetCategoryController@getListAjax']);
    Route::get('/create', ['as' => 'asset_category.create', 'uses' => 'AssetCategoryController@create']);
    Route::get('/show/{id}', ['as' => 'asset_category.show', 'uses' => 'AssetCategoryController@show']);    
    Route::get('/preview/{id}', ['as' => 'asset_category.preview', 'uses' => 'AssetCategoryController@preview']);    
    Route::post('/store', ['as' => 'asset_category.store', 'uses' => 'AssetCategoryController@store']);
    Route::get('/edit/{id}', ['as' => 'asset_category.edit', 'uses' => 'AssetCategoryController@edit']);
    Route::put('/update/{id}', ['as' => 'asset_category.update', 'uses' => 'AssetCategoryController@update']);
    Route::delete('/delete/{id}', ['as' => 'asset_category.destroy', 'uses' => 'AssetCategoryController@destroy']);
});