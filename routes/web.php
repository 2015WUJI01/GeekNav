<?php

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

Route::get('/', 'IndexController@index');
Route::get('/test', function (){
    return view('welcome');
});
Route::get('/testing', 'TestController@test');
Route::resource('link', 'LinkController');
Route::post('link/{id}/visit', 'LinkController@visitLink');
Route::resource('category', 'CategoryController');

//Route::get('link', $callback);
//Route::post('link', $callback);
//Route::put($uri, $callback);
//Route::patch($uri, $callback);
//Route::delete($uri, $callback);
//Route::options($uri, $callback);
