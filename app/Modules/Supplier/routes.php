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
Route::group(['prefix' => 'supplier', 'namespace' => 'App\Modules\Supplier\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'supplier.index', 'uses' => 'SupplierController@index']);
    Route::get('/getListAjax', ['as' => 'supplier.getListAjax', 'uses' => 'SupplierController@getListAjax']);
    Route::get('/create', ['as' => 'supplier.create', 'uses' => 'SupplierController@create']);
    Route::get('/show/{id}', ['as' => 'supplier.show', 'uses' => 'SupplierController@show']);    
    Route::get('/preview/{id}', ['as' => 'supplier.preview', 'uses' => 'SupplierController@preview']);    
    Route::post('/store', ['as' => 'supplier.store', 'uses' => 'SupplierController@store']);
    Route::get('/edit/{id}', ['as' => 'supplier.edit', 'uses' => 'SupplierController@edit']);
    Route::put('/update/{id}', ['as' => 'supplier.update', 'uses' => 'SupplierController@update']);
    Route::delete('/delete/{id}', ['as' => 'supplier.destroy', 'uses' => 'SupplierController@destroy']);
});