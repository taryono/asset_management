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

Route::group(['prefix' => 'management', 'namespace' => 'App\Modules\Management\Controllers', 'middleware' => ['web', 'admin']], function () {
    Route::get('/', ['as' => 'management.index', 'uses' => 'ManagementController@index']);
    Route::get('/getListAjax', ['as' => 'management.getListAjax', 'uses' => 'ManagementController@getListAjax']);
    Route::get('/create', ['as' => 'management.create', 'uses' => 'ManagementController@create']);
    Route::get('/filterArea', ['as' => 'management.filterArea', 'uses' => 'ManagementController@filterArea']);
    Route::get('/show/{id}', ['as' => 'management.show', 'uses' => 'ManagementController@show']);
    Route::get('/preview/{id}', ['as' => 'management.preview', 'uses' => 'ManagementController@preview']);
    Route::post('/store', ['as' => 'management.store', 'uses' => 'ManagementController@store']);
    Route::get('/edit/{id}', ['as' => 'management.edit', 'uses' => 'ManagementController@edit']);
    Route::put('/update/{id}', ['as' => 'management.update', 'uses' => 'ManagementController@update']);
    Route::delete('/delete/{id}', ['as' => 'management.destroy', 'uses' => 'ManagementController@destroy']);

    Route::get('/area', ['as' => 'management.children', 'uses' => 'ManagementController@area']);
    Route::get('/children', ['as' => 'management.children', 'uses' => 'ManagementController@children']);
    Route::get('/addChildren', ['as' => 'management.addChildren', 'uses' => 'ManagementController@addChildren']);

    Route::get('/structure', ['as' => 'management.structure', 'uses' => 'ManagementController@structure']);
    Route::any('/report_in', ['as' => 'management.report_in', 'uses' => 'ManagementController@report_in']);
    Route::get('/report_out', ['as' => 'management.report_out', 'uses' => 'ManagementController@report_out']);
    Route::get('/acl', ['as' => 'management.acl', 'uses' => 'ManagementController@acl']);
    Route::get('/mosque', ['as' => 'management.mosque', 'uses' => 'ManagementController@mosque']);
    Route::get('/education', ['as' => 'management.education', 'uses' => 'ManagementController@education']);
    Route::get('/asset', ['as' => 'management.asset', 'uses' => 'ManagementController@asset']);
    Route::get('/post', ['as' => 'management.post', 'uses' => 'ManagementController@post']);
    Route::get('/page', ['as' => 'management.page', 'uses' => 'ManagementController@page']);
    Route::get('/slider', ['as' => 'management.slider', 'uses' => 'ManagementController@slider']);
    Route::get('/gallery', ['as' => 'management.gallery', 'uses' => 'ManagementController@gallery']);
});
