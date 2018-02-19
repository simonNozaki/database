<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * ログイン後のユーザのログイン先。
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * コントローラクラスのコンストラクタ。
     * @return void
     */
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    /**
     * GitHubの認証ページヘユーザーをリダイレクトする。
     * OAuthプロバイダへのリダイレクトを担う。
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(){
        return Socialite::driver('github')->redirect();
    }

    /**
     * GitHubからユーザー情報を取得する。
     * $user->token;
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(){
        $user = Socialite::driver('github')->user();
    }
}
