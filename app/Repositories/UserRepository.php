<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Repositories\UserRepository;
use App\Constants\CodeDefine;

class UserRepository implements UserRepositoryInterface {
	public function getUserById($id) {
		$cd = new CodeDefine();
		try{
		    $userInfos = DB::table ( 'artist_base.users' )->where ( 'id', '=', "{$id}" )->first ();
		return $userInfos;
		}catch (Exception $e){
			Log::error($cd->EXE_ERR);
			throw new Exception();
		}
	}
	public function featchLatestPosting($id) {
		$cd = new CodeDefine();
		try {
			$posted = DB::table ( 'artist_master' )
			    ->where ( 'user_id', '=', "{$id}" )->orderBy ( 'artist_id' )->limit ( 10 )->get ();
			return $posted;
		} catch ( Exception $e ) {
			Log::error($cd->EXE_ERR);
			throw new Exception();
		}
	}
}

?>
