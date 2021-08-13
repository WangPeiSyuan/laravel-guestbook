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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//PostController
Route::get('/post', 'PostController@index');
Route::post('/post', 'PostController@store');
//刪除
Route::delete('/post/{id}', 'PostController@destroy')->name('post.destroy');
// Route::post('/post/{post}', 'PostController@destroybyajax');

//編輯
Route::get('post/{post}/edit','PostController@edit');
Route::patch('/post/{post}','PostController@update');

//MessageController
//留言
Route::get('/post/{post}/messages','MessageController@showmessage');
Route::post('post/{post}/messages', 'MessageController@store');
Route::delete('/post/{post}/messages/{id}', 'MessageController@destroy')->name('message.destroy');