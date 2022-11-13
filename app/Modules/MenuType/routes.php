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
Route::group(['prefix' => 'menu_type', 'namespace' => 'App\Modules\MenuType\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'menu_type.index', 'uses' => 'MenuTypeController@index']);
    Route::get('/settings', ['as' => 'menu_type.settings', 'uses' => 'MenuTypeController@settings']);
    Route::get('/getListAjax', ['as' => 'menu_type.getListAjax', 'uses' => 'MenuTypeController@getListAjax']);
    Route::get('/create', ['as' => 'menu_type.create', 'uses' => 'MenuTypeController@create']);
    Route::get('/pages', ['as' => 'menu_type.pages', 'uses' => 'MenuTypeController@pages']);
    Route::get('/profile', ['as' => 'menu_type.profile', 'uses' => 'MenuTypeController@profile']);
    Route::get('/change_password', ['as' => 'menu_type.change_password', 'uses' => 'MenuTypeController@change_password']);
    Route::get('/show/{id}', ['as' => 'menu_type.show', 'uses' => 'MenuTypeController@show']);    
    Route::get('/preview/{id}', ['as' => 'menu_type.preview', 'uses' => 'MenuTypeController@preview']);    
    Route::post('/store', ['as' => 'menu_type.store', 'uses' => 'MenuTypeController@store']);
    Route::get('/edit/{id}', ['as' => 'menu_type.edit', 'uses' => 'MenuTypeController@edit']);
    Route::get('/detail/{id}', ['as' => 'menu_type.detail', 'uses' => 'MenuTypeController@detail']);
    Route::put('/update/{id}', ['as' => 'menu_type.update', 'uses' => 'MenuTypeController@update']);
    Route::delete('/delete/{id}', ['as' => 'menu_type.destroy', 'uses' => 'MenuTypeController@destroy']);
});