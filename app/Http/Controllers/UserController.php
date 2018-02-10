<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;

//ユーザ登録後の操作を、このコントローラで制御する
//新規登録、ログインはデフォルトのコントローラを利用する
class UserController extends Controller{

  public function __construct(UserRepositoryInterface $userRepository){
    $this->userRepository = $userRepository;
  }

  public function top($id){
    $userInfos = $this->userRepository->getUserById($id);
    return view('User.top', compact('userInfos'));
  }

}

?>
