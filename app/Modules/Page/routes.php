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
Route::group(['prefix' => 'page', 'namespace' => 'App\Modules\Page\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'page.index', 'uses' => 'PageController@index']);
    Route::get('/getListAjax', ['as' => 'page.getListAjax', 'uses' => 'PageController@getListAjax']);
    Route::get('/create', ['as' => 'page.create', 'uses' => 'PageController@create']);
    Route::get('/show/{id}', ['as' => 'page.show', 'uses' => 'PageController@show']);    
    Route::get('/preview/{id}', ['as' => 'page.preview', 'uses' => 'PageController@preview']);    
    Route::post('/store', ['as' => 'page.store', 'uses' => 'PageController@store']);
    Route::get('/edit/{id}', ['as' => 'page.edit', 'uses' => 'PageController@edit']);
    Route::put('/update/{id}', ['as' => 'page.update', 'uses' => 'PageController@update']);
    Route::delete('/delete/{id}', ['as' => 'page.destroy', 'uses' => 'PageController@destroy']);
    Route::post('file-upload', ['as' => 'page.fileUpload', 'uses' => 'PageController@fileUpload']);   
});