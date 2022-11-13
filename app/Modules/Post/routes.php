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
Route::group(['prefix' => 'post', 'namespace' => 'App\Modules\Post\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'post.index', 'uses' => 'PostController@index']);
    Route::get('/getListAjax', ['as' => 'post.getListAjax', 'uses' => 'PostController@getListAjax']);
    Route::get('/create', ['as' => 'post.create', 'uses' => 'PostController@create']);
    Route::get('/show/{id}', ['as' => 'post.show', 'uses' => 'PostController@show']);    
    Route::get('/preview/{id}', ['as' => 'post.preview', 'uses' => 'PostController@preview']);    
    Route::post('/store', ['as' => 'post.store', 'uses' => 'PostController@store']);
    Route::get('/edit/{id}', ['as' => 'post.edit', 'uses' => 'PostController@edit']);
    Route::put('/update/{id}', ['as' => 'post.update', 'uses' => 'PostController@update']);
    Route::delete('/delete/{id}', ['as' => 'post.destroy', 'uses' => 'PostController@destroy']);
   
});