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
Route::group(['prefix' => 'asset_type', 'namespace' => 'App\Modules\AssetType\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'asset_type.index', 'uses' => 'AssetTypeController@index']);
    Route::get('/getListAjax', ['as' => 'asset_type.getListAjax', 'uses' => 'AssetTypeController@getListAjax']);
    Route::get('/create', ['as' => 'asset_type.create', 'uses' => 'AssetTypeController@create']);
    Route::get('/show/{id}', ['as' => 'asset_type.show', 'uses' => 'AssetTypeController@show']);    
    Route::get('/preview/{id}', ['as' => 'asset_type.preview', 'uses' => 'AssetTypeController@preview']);    
    Route::post('/store', ['as' => 'asset_type.store', 'uses' => 'AssetTypeController@store']);
    Route::get('/edit/{id}', ['as' => 'asset_type.edit', 'uses' => 'AssetTypeController@edit']);
    Route::put('/update/{id}', ['as' => 'asset_type.update', 'uses' => 'AssetTypeController@update']);
    Route::delete('/delete/{id}', ['as' => 'asset_type.destroy', 'uses' => 'AssetTypeController@destroy']);
});