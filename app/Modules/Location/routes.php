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
Route::group(['prefix' => 'location', 'namespace' => 'App\Modules\Location\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'location.index', 'uses' => 'LocationController@index']);
    Route::get('/getListAjax', ['as' => 'location.getListAjax', 'uses' => 'LocationController@getListAjax']);
    Route::get('/create', ['as' => 'location.create', 'uses' => 'LocationController@create']);
    Route::get('/show/{id}', ['as' => 'location.show', 'uses' => 'LocationController@show']);    
    Route::get('/preview/{id}', ['as' => 'location.preview', 'uses' => 'LocationController@preview']);    
    Route::post('/store', ['as' => 'location.store', 'uses' => 'LocationController@store']);
    Route::get('/edit/{id}', ['as' => 'location.edit', 'uses' => 'LocationController@edit']);
    Route::put('/update/{id}', ['as' => 'location.update', 'uses' => 'LocationController@update']);
    Route::delete('/delete/{id}', ['as' => 'location.destroy', 'uses' => 'LocationController@destroy']);
});