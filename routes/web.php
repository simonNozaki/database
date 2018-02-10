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

Route::prefix('database')->group(function(){

  Route::get('index', 'ArtistController@index');

  Route::get('new', 'ArtistController@new');

  Route::post('search', 'ArtistController@search');

  Route::post('store', 'ArtistController@store');

  Route::get('show/{name}', 'ArtistController@show');

  Route::post('storeTitles', 'ArtistController@storeTitles');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');