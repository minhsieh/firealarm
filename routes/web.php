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
Route::get('privacy','IndexController@privacy');

Route::get('login/facebook', 'Auth\FacebookController@redirectToProvider');

Route::get('login/facebook/callback', 'Auth\FacebookController@handleProviderCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/pagetoken', 'HomeController@pageToken');