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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('categories','CategoryController');
Route::resource('posts','PostController');
Route::get('/home', 'HomeController@index')->name('home');

// Route::get('posts/create', 'PostController@create');
Route::post('posts/create', 'PostController@autoprovince')->name('autocomplete.show');