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
Route::group(['prefix' => 'city', 'namespace' => 'App\Modules\City\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'city.index', 'uses' => 'CityController@index']);
    Route::get('/getListAjax', ['as' => 'city.getListAjax', 'uses' => 'CityController@getListAjax']);
    Route::get('/create', ['as' => 'city.create', 'uses' => 'CityController@create']);
    Route::get('/show/{id}', ['as' => 'city.show', 'uses' => 'CityController@show']);    
    Route::get('/preview/{id}', ['as' => 'city.preview', 'uses' => 'CityController@preview']);    
    Route::post('/store', ['as' => 'city.store', 'uses' => 'CityController@store']);
    Route::get('/edit/{id}', ['as' => 'city.edit', 'uses' => 'CityController@edit']);
    Route::put('/update/{id}', ['as' => 'city.update', 'uses' => 'CityController@update']);
    Route::delete('/delete/{id}', ['as' => 'city.destroy', 'uses' => 'CityController@destroy']);
});