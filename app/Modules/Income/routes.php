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
Route::group(['prefix' => 'income', 'namespace' => 'App\Modules\Income\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'income.index', 'uses' => 'IncomeController@index']);
    Route::get('/getListAjax', ['as' => 'income.getListAjax', 'uses' => 'IncomeController@getListAjax']);
    Route::get('/create', ['as' => 'income.create', 'uses' => 'IncomeController@create']);
    Route::get('/show/{id}', ['as' => 'income.show', 'uses' => 'IncomeController@show']);    
    Route::get('/preview/{id}', ['as' => 'income.preview', 'uses' => 'IncomeController@preview']);    
    Route::post('/store', ['as' => 'income.store', 'uses' => 'IncomeController@store']);
    Route::get('/edit/{id}', ['as' => 'income.edit', 'uses' => 'IncomeController@edit']);
    Route::get('/category/{category}', ['as' => 'income.category_edit', 'uses' => 'IncomeController@category']);
    Route::put('/update/{id}', ['as' => 'income.update', 'uses' => 'IncomeController@update']);
    Route::delete('/delete/{id}', ['as' => 'income.destroy', 'uses' => 'IncomeController@destroy']);
});