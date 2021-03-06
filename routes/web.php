<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('/','HomePageController');

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

Route::get('/home', 'HomeController@index')->name('home');



Route::middleware('auth')->group(function(){
  Route::resource('category','CategoryController');

  Route::resource('tags','TagsController');

  Route::resource('post','PostController');

  Route::get('trashed-posts','PostController@trashed')->name('trashed-posts.index');

  Route::put('restore-posts/{post}','PostController@restore')->name('restore-posts');
});





