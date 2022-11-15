<?php

use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\File\File;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();  
Route::get('/welcome', [App\Http\Controllers\WelcomeController::class, 'index', 'middleware' => ['guest']])->name('welcome');
Route::get('/welcome/children', ['as' => 'welcome.children', 'uses' => 'App\Http\Controllers\WelcomeController@children']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user/profile/{id}', ['as' => 'user.profile', 'uses' => 'App\Modules\User\Controllers\UserController@profile']);
Route::get('/admin/refresh', ['as' => 'admin.refresh', 'uses' => 'App\Http\Controllers\MainController@refresh']);

Route::get('/pages/{slug}', ['as' => 'post.page', 'uses' => 'App\Http\Controllers\WelcomeController@page']);
Route::get('/post/{category}/{date}/{slug}', ['as' => 'post.post', 'uses' => 'App\Http\Controllers\WelcomeController@post']);
Route::get('/search-post', ['as' => 'search.post', 'uses' => 'App\Http\Controllers\WelcomeController@index']);
   
Route::get('photos/{filename}', function ($filename)  { 
    // Add folder path here instead of storing in the database. 
    $file = (new File(storage_path('app/public/photos/'.$filename))); 
    $response = Response::make($file->getContent(), 200);
    $response->header("Content-Type", $file->getMimeType());
    return $response;
});
 
Route::get('assets/{filename}', function ($filename)  {
    // Add folder path here instead of storing in the database. 
    $file = (new File(public_path('storage/assets/'.$filename))); 
    $response = Response::make($file->getContent(), 200);
    $response->header("Content-Type", $file->getMimeType());
    return $response;
});

Route::get('nota/{filename}', function ($filename)  {
    // Add folder path here instead of storing in the database. 
    $file = (new File(public_path('storage/nota/'.$filename))); 
    $response = Response::make($file->getContent(), 200);
    $response->header("Content-Type", $file->getMimeType());
    return $response;
});

Route::get('albums/{filename}', function ($filename)  {
    // Add folder path here instead of storing in the database. 
    $file = (new File(storage_path('app/public/albums/'.$filename))); 
    $response = Response::make($file->getContent(), 200);
    $response->header("Content-Type", $file->getMimeType());
    return $response;
});

Route::get('galleries/{filename}', function ($filename)  {
    // Add folder path here instead of storing in the database. 
    $file = (new File(storage_path('app/public/gallery/'.$filename))); 
    $response = Response::make($file->getContent(), 200);
    $response->header("Content-Type", $file->getMimeType());
    return $response;
});

Route::get('mosque_file/{filename}', function ($filename)  { 
    // Add folder path here instead of storing in the database. 
    $file = (new File(storage_path('app/public/mosque/'.$filename))); 
    $response = Response::make($file->getContent(), 200);
    $response->header("Content-Type", $file->getMimeType());
    return $response;
});

Route::get('logo/{filename}', function ($filename)  {
    // Add folder path here instead of storing in the database. 
    $file = (new File(storage_path('app/public/logo/'.$filename))); 
    $response = Response::make($file->getContent(), 200);
    $response->header("Content-Type", $file->getMimeType());
    return $response;
});

Route::get('sliders/{filename}', function ($filename)  {
    // Add folder path here instead of storing in the database. 
    $file = (new File(storage_path('app/public/sliders/'.$filename))); 
    $response = Response::make($file->getContent(), 200);
    $response->header("Content-Type", $file->getMimeType());
    return $response;
});