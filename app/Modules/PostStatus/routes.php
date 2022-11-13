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
Route::group(['prefix' => 'post_status', 'namespace' => 'App\Modules\PostStatus\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'post_status.index', 'uses' => 'PostStatusController@index']);
    Route::get('/getListAjax', ['as' => 'post_status.getListAjax', 'uses' => 'PostStatusController@getListAjax']);
    Route::get('/create', ['as' => 'post_status.create', 'uses' => 'PostStatusController@create']);
    Route::get('/show/{id}', ['as' => 'post_status.show', 'uses' => 'PostStatusController@show']);    
    Route::get('/preview/{id}', ['as' => 'post_status.preview', 'uses' => 'PostStatusController@preview']);    
    Route::post('/store', ['as' => 'post_status.store', 'uses' => 'PostStatusController@store']);
    Route::get('/edit/{id}', ['as' => 'post_status.edit', 'uses' => 'PostStatusController@edit']);
    Route::put('/update/{id}', ['as' => 'post_status.update', 'uses' => 'PostStatusController@update']);
    Route::delete('/delete/{id}', ['as' => 'post_status.destroy', 'uses' => 'PostStatusController@destroy']);
   
});