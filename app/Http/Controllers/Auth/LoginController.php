<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use Redirect;
use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
class LoginController extends Controller{

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
      try{
        $user = Socialite::driver('github')->user();
      }catch(Exception $e){
        return Redirect::to('/login');
      }
      // ユーザ情報がなければ、Githubから情報を取得して作成する
      $authUser = $this->findOrCreateUser($user);

      Auth::login($authUser, true);

      return Redirect::to('/home');
    }

    /**
     * ユーザ情報がなければ作成する
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($githubUser){
        if ($authUser = User::where('github_id', $githubUser->id)->first()) {
            return $authUser;
        }else{
          return User::create([
              'name' => $githubUser->name,
              'email' => $githubUser->email,
              'github_id' => $githubUser->id,
              'avatar' => $githubUser->avatar
          ]);
        }
    }
}
