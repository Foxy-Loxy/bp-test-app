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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'Blog\PostController@index')->name('index');
Route::get('/show/{post}', 'Blog\PostController@show')->name('showPost');

Route::group([
    'middleware' => 'auth'
], function () {
    Route::get('/create', 'Blog\PostController@create')->name('createPost');
    Route::post('/create', 'Blog\PostController@save')->name('savePost');

    Route::get('/update/{post}', 'Blog\PostController@showUpdate')->name('showUpdatePost');
    Route::put('/update/{post}', 'Blog\PostController@update')->name('updatePost');

    Route::delete('/delete/{post}', 'Blog\PostController@delete')->name('deletePost');

    Route::post('/comment', 'Blog\CommentController@save')->name('createComment');

    Route::put('/like/{post}', 'Blog\LikeController@update')->name('likePost');
});

