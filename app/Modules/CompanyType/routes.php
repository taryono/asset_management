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
Route::group(['prefix' => 'company_type', 'namespace' => 'App\Modules\CompanyType\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'company_type.index', 'uses' => 'CompanyTypeController@index']);
    Route::get('/getListAjax', ['as' => 'company_type.getListAjax', 'uses' => 'CompanyTypeController@getListAjax']);
    Route::get('/create', ['as' => 'company_type.create', 'uses' => 'CompanyTypeController@create']);
    Route::get('/show/{id}', ['as' => 'company_type.show', 'uses' => 'CompanyTypeController@show']);    
    Route::get('/preview/{id}', ['as' => 'company_type.preview', 'uses' => 'CompanyTypeController@preview']);    
    Route::post('/store', ['as' => 'company_type.store', 'uses' => 'CompanyTypeController@store']);
    Route::get('/edit/{id}', ['as' => 'company_type.edit', 'uses' => 'CompanyTypeController@edit']);
    Route::put('/update/{id}', ['as' => 'company_type.update', 'uses' => 'CompanyTypeController@update']);
    Route::delete('/delete/{id}', ['as' => 'company_type.destroy', 'uses' => 'CompanyTypeController@destroy']);
});