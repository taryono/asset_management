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
Route::group(['prefix' => 'asset_purchase', 'namespace' => 'App\Modules\AssetPurchase\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'asset_purchase.index', 'uses' => 'AssetPurchaseController@index']);
    Route::get('/getListAjax', ['as' => 'asset_purchase.getListAjax', 'uses' => 'AssetPurchaseController@getListAjax']);
    Route::get('/create', ['as' => 'asset_purchase.create', 'uses' => 'AssetPurchaseController@create']);
    Route::get('/show/{id}', ['as' => 'asset_purchase.show', 'uses' => 'AssetPurchaseController@show']);    
    Route::get('/preview/{id}', ['as' => 'asset_purchase.preview', 'uses' => 'AssetPurchaseController@preview']);    
    Route::post('/store', ['as' => 'asset_purchase.store', 'uses' => 'AssetPurchaseController@store']);
    Route::get('/edit/{id}', ['as' => 'asset_purchase.edit', 'uses' => 'AssetPurchaseController@edit']);
    Route::put('/update/{id}', ['as' => 'asset_purchase.update', 'uses' => 'AssetPurchaseController@update']);
    Route::delete('/delete/{id}', ['as' => 'asset_purchase.destroy', 'uses' => 'AssetPurchaseController@destroy']);
});