<?php


namespace Tests\Unit;

use Tests\TestCase;
use Exception;
use App\Constants\CodeDefine;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class UserRepositoryTest extends TestCase{

    /** @test */
	public function getUserById_Case1(){
		$userRepository = new UserRepository();
		try{
			$userInfos= $userRepository->getUserById(1);
			echo "取得件数: ".count($userInfos);
		    $this->assertEquals(count($userInfos), 1);
		    $this->assertEquals($userInfos[0]->name, "snozaki");
		}catch (Exception $e){
			Log::error();
			throw new Exception();
		}
	}

	/** @test */
	public function fetchLatestPosting(){
		$userRepository = new UserRepository();
		try{
			$posted = $userRepository->featchLatestPosting(1);
			$this->assertEquals(count($posted), 8);
			$this->assertEquals($posted[0]->name, "THREE LIGHTS DOWN KINGS");
		}catch (Exception $e){
			Log::error();
			throw new Exception();
		}
	}

}

?>