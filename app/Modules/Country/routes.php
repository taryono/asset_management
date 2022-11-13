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
Route::group(['prefix' => 'country', 'namespace' => 'App\Modules\Country\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'country.index', 'uses' => 'CountryController@index']);
    Route::get('/getListAjax', ['as' => 'country.getListAjax', 'uses' => 'CountryController@getListAjax']);
    Route::get('/create', ['as' => 'country.create', 'uses' => 'CountryController@create']);
    Route::get('/show/{id}', ['as' => 'country.show', 'uses' => 'CountryController@show']);    
    Route::get('/preview/{id}', ['as' => 'country.preview', 'uses' => 'CountryController@preview']);    
    Route::post('/store', ['as' => 'country.store', 'uses' => 'CountryController@store']);
    Route::get('/edit/{id}', ['as' => 'country.edit', 'uses' => 'CountryController@edit']);
    Route::put('/update/{id}', ['as' => 'country.update', 'uses' => 'CountryController@update']);
    Route::delete('/delete/{id}', ['as' => 'country.destroy', 'uses' => 'CountryController@destroy']);
});