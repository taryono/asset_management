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
Route::group(['prefix' => 'attribute', 'namespace' => 'App\Modules\Attribute\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'attribute.index', 'uses' => 'AttributeController@index']);
    Route::get('/getListAjax', ['as' => 'attribute.getListAjax', 'uses' => 'AttributeController@getListAjax']);
    Route::get('/create/{menu_id}', ['as' => 'attribute.create', 'uses' => 'AttributeController@create']);
    Route::get('/show/{id}', ['as' => 'attribute.show', 'uses' => 'AttributeController@show']);    
    Route::get('/preview/{id}', ['as' => 'attribute.preview', 'uses' => 'AttributeController@preview']);    
    Route::post('/store', ['as' => 'attribute.store', 'uses' => 'AttributeController@store']);
    Route::get('/edit/{id}', ['as' => 'attribute.edit', 'uses' => 'AttributeController@edit']);
    Route::put('/update/{id}', ['as' => 'attribute.update', 'uses' => 'AttributeController@update']);
    Route::delete('/delete/{id}', ['as' => 'attribute.destroy', 'uses' => 'AttributeController@destroy']);
});