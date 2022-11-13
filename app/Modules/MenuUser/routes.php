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
Route::group(['prefix' => 'menu_user', 'namespace' => 'App\Modules\MenuUser\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'menu_user.index', 'uses' => 'MenuUserController@index']);
    Route::get('/getListAjax', ['as' => 'menu_user.getListAjax', 'uses' => 'MenuUserController@getListAjax']);
    Route::get('/create', ['as' => 'menu_user.create', 'uses' => 'MenuUserController@create']);
    Route::get('/show/{id}', ['as' => 'menu_user.show', 'uses' => 'MenuUserController@show']);    
    Route::get('/preview/{id}', ['as' => 'menu_user.preview', 'uses' => 'MenuUserController@preview']);    
    Route::post('/store', ['as' => 'menu_user.store', 'uses' => 'MenuUserController@store']);
    Route::get('/edit/{id}', ['as' => 'menu_user.edit', 'uses' => 'MenuUserController@edit']);
    Route::put('/update/{id}', ['as' => 'menu_user.update', 'uses' => 'MenuUserController@update']);
    Route::delete('/delete/{id}', ['as' => 'menu_user.destroy', 'uses' => 'MenuUserController@destroy']);

    Route::post('/updateField', ['as' => 'menu_user.updateField', 'uses' => 'MenuUserController@updateField']);
});