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
Route::group(['prefix' => 'assignment', 'namespace' => 'App\Modules\Assignment\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'assignment.index', 'uses' => 'AssignmentController@index']);
    Route::get('/getListAjax', ['as' => 'assignment.getListAjax', 'uses' => 'AssignmentController@getListAjax']);
    Route::get('/create', ['as' => 'assignment.create', 'uses' => 'AssignmentController@create']);
    Route::get('/show/{id}', ['as' => 'assignment.show', 'uses' => 'AssignmentController@show']);    
    Route::get('/preview/{id}', ['as' => 'assignment.preview', 'uses' => 'AssignmentController@preview']);   
    Route::post('/store', ['as' => 'assignment.store', 'uses' => 'AssignmentController@store']);
    Route::get('/edit/{id}', ['as' => 'assignment.edit', 'uses' => 'AssignmentController@edit']);
    Route::put('/update/{id}', ['as' => 'assignment.update', 'uses' => 'AssignmentController@update']);
    Route::delete('/delete/{id}', ['as' => 'assignment.destroy', 'uses' => 'AssignmentController@destroy']);
});