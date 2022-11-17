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
Route::group(['prefix' => 'position', 'namespace' => 'App\Modules\Position\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'position.index', 'uses' => 'PositionController@index']);
    Route::get('/getListAjax', ['as' => 'position.getListAjax', 'uses' => 'PositionController@getListAjax']);
    Route::get('/getListAjaxEmployees', ['as' => 'position.getListAjaxEmployees', 'uses' => 'PositionController@getListAjaxEmployees']);
    Route::get('/create', ['as' => 'position.create', 'uses' => 'PositionController@create']);
    Route::get('/show/{id}', ['as' => 'position.show', 'uses' => 'PositionController@show']);    
    Route::get('/preview/{id}', ['as' => 'position.preview', 'uses' => 'PositionController@preview']);    
    Route::post('/store', ['as' => 'position.store', 'uses' => 'PositionController@store']);
    Route::get('/structure', ['as' => 'position.structure', 'uses' => 'PositionController@structure']);
    Route::get('/edit/{id}', ['as' => 'position.edit', 'uses' => 'PositionController@edit']);
    Route::put('/update/{id}', ['as' => 'position.update', 'uses' => 'PositionController@update']);
    Route::delete('/delete/{id}', ['as' => 'position.destroy', 'uses' => 'PositionController@destroy']);
});