<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserRepository implements UserRepositoryInterface{

  public function getUserById($id){
    $userInfos = DB::table('users')
                 ->select('*')
                 ->where('id', '=', "%{$id}%");
    return $userInfos;
  }

}

?>
