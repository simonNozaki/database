<?php

namespace App\Repositories;


interface UserRepositoryInterface{

	/**  IDでユーザ情報を取得します */
    public function getUserById($id);

    /** ユーザの投稿したレコード過去10件までを取得し表示します */
    public function featchLatestPosting($id);

}


?>
