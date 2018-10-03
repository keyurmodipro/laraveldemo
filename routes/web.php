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

Route::get('/login', function () {
    if (Auth::check()) {
        return view('layouts.index');
    } else {
        return view('layouts.login');
    }
});
Route::get('/register', function () {
    return view('layouts.register');
});

Route::get('/addmovies', function () {
    if (Auth::check()) {
        return view('partials.admin.addmovies');
    } else {
        return view('layouts.login');
    }
});
//


Route::post('login', 'commonController@login');
Route::post('signup', 'commonController@signup');
Route::get('logout', 'commonController@Logout');

Route::resource('users', 'usersController');



Route::get('/', 'FrontController@movies');
Route::post('add_movie', 'AdminController@add_movie');
Route::post('comments', 'AdminController@comments');

Route::get('/{id}', 'FrontController@moviessingle'); // for admin side 

