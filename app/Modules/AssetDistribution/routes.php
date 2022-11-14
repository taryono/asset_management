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
Route::group(['prefix' => 'asset_distribution', 'namespace' => 'App\Modules\AssetDistribution\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'asset_distribution.index', 'uses' => 'AssetDistributionController@index']);
    Route::get('/getListAjax', ['as' => 'asset_distribution.getListAjax', 'uses' => 'AssetDistributionController@getListAjax']);
    Route::get('/create', ['as' => 'asset_distribution.create', 'uses' => 'AssetDistributionController@create']);
    Route::get('/show/{id}', ['as' => 'asset_distribution.show', 'uses' => 'AssetDistributionController@show']);    
    Route::get('/preview/{id}', ['as' => 'asset_distribution.preview', 'uses' => 'AssetDistributionController@preview']);    
    Route::post('/store', ['as' => 'asset_distribution.store', 'uses' => 'AssetDistributionController@store']);
    Route::get('/edit/{id}', ['as' => 'asset_distribution.edit', 'uses' => 'AssetDistributionController@edit']);
    Route::put('/update/{id}', ['as' => 'asset_distribution.update', 'uses' => 'AssetDistributionController@update']);
    Route::delete('/delete/{id}', ['as' => 'asset_distribution.destroy', 'uses' => 'AssetDistributionController@destroy']);
});