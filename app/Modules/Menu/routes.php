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
Route::group(['prefix' => 'menu', 'namespace' => 'App\Modules\Menu\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'menu.index', 'uses' => 'MenuController@index']);
    Route::get('/settings', ['as' => 'menu.settings', 'uses' => 'MenuController@settings']);
    Route::get('/getListAjax', ['as' => 'menu.getListAjax', 'uses' => 'MenuController@getListAjax']);
    Route::get('/create', ['as' => 'menu.create', 'uses' => 'MenuController@create']);
    Route::get('/pages', ['as' => 'menu.pages', 'uses' => 'MenuController@pages']);
    Route::get('/profile', ['as' => 'menu.profile', 'uses' => 'MenuController@profile']);
    Route::get('/change_password', ['as' => 'menu.change_password', 'uses' => 'MenuController@change_password']);
    Route::get('/show/{id}', ['as' => 'menu.show', 'uses' => 'MenuController@show']);    
    Route::get('/preview/{id}', ['as' => 'menu.preview', 'uses' => 'MenuController@preview']);    
    Route::post('/store', ['as' => 'menu.store', 'uses' => 'MenuController@store']);
    Route::get('/edit/{id}', ['as' => 'menu.edit', 'uses' => 'MenuController@edit']);
    Route::get('/detail/{id}', ['as' => 'menu.detail', 'uses' => 'MenuController@detail']);
    Route::put('/update/{id}', ['as' => 'menu.update', 'uses' => 'MenuController@update']);
    Route::delete('/delete/{id}', ['as' => 'menu.destroy', 'uses' => 'MenuController@destroy']);
});