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
Route::get('oauth/{provider}', 'Auth\SocialAccountController@redirectToProvider')->name('socialite');
Route::get('oauth/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback')->name('socialite.callback');

Route::get('/home', 'HomeController@index')->name('home');
