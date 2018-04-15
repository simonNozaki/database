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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

/**
*  アーティスト系リクエストのルーティング
*/
Route::prefix('database')->group(function(){
  // 登録されているArtistの一覧
  Route::get('index', 'ArtistController@index');
  // 新規Artist登録
  Route::get('new', 'ArtistController@new');
  // Artistの検索
  Route::post('search', 'ArtistController@search');
  // Artistの登録
  Route::post('store', 'ArtistController@store');
  // Artistの詳細ページ表示
  Route::get('show/{name}', 'ArtistController@show');
  // Artistのアルバムを登録する
  Route::post('storeTitles', 'ArtistController@storeTitles');
  Route::get('{name}/registerTitle', 'ArtistController@titleForm');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
*  ユーザ系リクエストのルーティング
*/
Route::prefix('user')->group(function(){
  // ユーザトップページ
  Route::get('{id}', 'UserController@top');
});

/**
*  ソーシャル認証リクエストのルーティング
*/
//Githubへのリダイレクト
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
//ユーザ情報の取得
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
