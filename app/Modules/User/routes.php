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
Route::group(['prefix' => 'user', 'namespace' => 'App\Modules\User\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'user.index', 'uses' => 'UserController@index']);
    Route::get('/getListAjax', ['as' => 'user.getListAjax', 'uses' => 'UserController@getListAjax']);
    Route::get('/getListJamaahAjax', ['as' => 'user.getListJamaahAjax', 'uses' => 'UserController@getListJamaahAjax']);
    Route::get('/create', ['as' => 'user.create', 'uses' => 'UserController@create']);
    Route::get('/create_jamaah', ['as' => 'user.create_jamaah', 'uses' => 'UserController@create_jamaah']);
    Route::get('/show/{id}', ['as' => 'user.show', 'uses' => 'UserController@show']);    
    Route::get('/preview/{id}', ['as' => 'user.preview', 'uses' => 'UserController@preview']);    
    Route::post('/store', ['as' => 'user.store', 'uses' => 'UserController@store']);
    Route::get('/edit/{id}', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
    Route::get('/edit_jamaah/{id}', ['as' => 'user.edit_jamaah', 'uses' => 'UserController@edit_jamaah']);
    Route::put('/update/{id}', ['as' => 'user.update', 'uses' => 'UserController@update']);
    Route::delete('/delete/{id}', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
});