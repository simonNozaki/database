<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\ArtistRepository;
use App\Constants\CodeDefine;
use Illuminate\Http\Request;

class ArtistRepositoryTest extends TestCase{

  /** @test */
  public function getAll(){
  	$artistRepository = new ArtistRepository();
  	$cd = new CodeDefine();
  	try{
  	  $records = $artistRepository->getAll();
  	  // 取得件数が1件以上あることを確認する
  	  $this->assertLessThan(count($records), 1);
  	}catch(Exception $e){
  	  Log::error($cd->EXE_ERR);
  	  throw new Exception();
  	}
  }

  /** @test */
  public function showArtistDetail(){
  	$artistRepository = new ArtistRepository();
  	try{
  		$result = $artistRepository->showArtistDetail("THREE LIGHTS DOWN KINGS");
  		$this->assertEquals($result['artistName']->category, "POP PUNK");
  	}catch (Exeption $e){
  		Log::error($cd->EXE_ERR);
  		throw new Exception();
  	}
  }

  /** @test */
//   public function getArtistByName(){
//   	$artistRepository = new ArtistRepository();
//   	$req = new Request();
//   	$name = $req->input ('name');
//   	echo "Input: " + $name;
//   	try{
//   		$result = $artistRepository->getArtistbyName($req);
//   		$this->assertEquals(count($result), 1);
//   	}catch (Exception $e){
//   		Log::error($cd->EXE_ERR);
//   		throw new Exception();
//   	}
//   }
}
?>