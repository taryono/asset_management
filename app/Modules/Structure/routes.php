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
Route::group(['prefix' => 'structure', 'namespace' => 'App\Modules\Structure\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'structure.index', 'uses' => 'StructureController@index']);
    Route::get('/getListAjax', ['as' => 'structure.getListAjax', 'uses' => 'StructureController@getListAjax']);
    Route::get('/getListAjaxStaff/{structure_id}', ['as' => 'structure.getListAjaxStaff', 'uses' => 'StructureController@getListAjaxStaff']);
    Route::get('/getListAjaxEmployees/{structure_id}', ['as' => 'structure.getListAjaxEmployees', 'uses' => 'StructureController@getListAjaxEmployees']);
    Route::get('/create', ['as' => 'structure.create', 'uses' => 'StructureController@create']);
    Route::get('/show/{id}', ['as' => 'structure.show', 'uses' => 'StructureController@show']);    
    Route::get('/preview/{id}', ['as' => 'structure.preview', 'uses' => 'StructureController@preview']);    
    Route::get('/graph/{id}', ['as' => 'structure.graph', 'uses' => 'StructureController@graph']);    
    Route::post('/store', ['as' => 'structure.store', 'uses' => 'StructureController@store']);
    Route::get('/staff/{id}', ['as' => 'structure.staff', 'uses' => 'StructureController@structure']);
    Route::get('/edit/{id}', ['as' => 'structure.edit', 'uses' => 'StructureController@edit']);
    Route::put('/update/{id}', ['as' => 'structure.update', 'uses' => 'StructureController@update']);
    Route::get('/nodes/{id}', ['as' => 'structure.nodes', 'uses' => 'StructureController@nodes']);
    Route::delete('/delete/{id}', ['as' => 'structure.destroy', 'uses' => 'StructureController@destroy']);
});