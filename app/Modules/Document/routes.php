<?php

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

Route::group(['prefix' => 'document', 'namespace' => 'App\Modules\Document\Controllers', 'middleware' => ['web']], function () {
    Route::get('/', ['as' => 'document.index', 'uses' => 'Document@index']);
    Route::post('/store', ['as' => 'document.store', 'uses' => 'Document@store']);
    Route::get('/edit/{id}', ['as' => 'document.edit', 'uses' => 'Document@edit']);
    Route::get('/addContent/{id}', ['as' => 'document.addContent', 'uses' => 'Document@addContent']);
    Route::PATCH('/storeContent/{id}', ['as' => 'document.storeContent', 'uses' => 'Document@storeContent']);
    Route::patch('/update/{id}', ['as' => 'document.update', 'uses' => 'Document@update']);
    Route::get('/delete/{id}', ['as' => 'document.delete', 'uses' => 'Document@delete']);
    Route::get('/create', ['as' => 'document.create', 'uses' => 'Document@create']);
    Route::get('/getDetail', ['as' => 'document.getDetail', 'uses' => 'Document@getDetail']);
    Route::post('/', ['as' => 'document.search', 'uses' => 'Document@index']);
    Route::post('/delete_row', ['as' => 'document.delete_row', 'uses' => 'Document@delete_row']);
    Route::get('/documentSearch', ['as' => 'document.documentSearch', 'uses' => 'Document@documentSearch']);
    Route::get('/getFormAtribute/{document_id}', ['as' => 'document.getFormAtribute', 'uses' => 'Document@getFormAtribute']);
    Route::post('/storeAttribute', ['as' => 'document.storeAttribute', 'uses' => 'Document@storeAttribute']);

    Route::get('/editAttribute/{attribute_id}', ['as' => 'document.editAttribute', 'uses' => 'Document@editAttribute']);

    Route::patch('/updateAttribute/{id}', ['as' => 'document.updateAttribute', 'uses' => 'Document@updateAttribute']);
});
