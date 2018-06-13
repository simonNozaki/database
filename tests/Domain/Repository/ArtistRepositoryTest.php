<?php

namespace Tests\Unit;

use Tests\TestCase;
use Exception;
use App\Repositories\ArtistRepository;
use App\Constants\CodeDefine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ArtistRepositoryTest extends TestCase{

  // 完了
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

  // 完了
  /** @test */
  public function showArtistDetail_Case1(){
  	$artistRepository = new ArtistRepository();
  	try{
  		$result = $artistRepository->showArtistDetail("THREE LIGHTS DOWN KINGS");
  		$this->assertEquals($result['artistName']->category, "POP PUNK");
  	}catch (Exception $e){
  		Log::error($cd->EXE_ERR);
  		throw new Exception();
  	}
  }

  /** @test */
  // 空の文字列で検索して、検索結果がないことを確認する
  public function showArtistDetail_Case2(){
  	$artistRepository = new ArtistRepository();
  	try{
  		$result = $artistRepository->showArtistDetail(null);
  		var_dump($result);
  		$this->assertEquals($result[0], "Nothing is searched");
  	}catch(Exception $e){
  		Log::error($cd->EXE_ERR);
  		throw new Exception();
  	}
  }

  /** @test */
  public function getArtistByName_Case1(){
    $name = "aaa";
    try {
			$records = DB::table ( 'artist_master' )->where ( 'name', 'like', "%{$name}%" )->get ();
			if (count ( $records ) == 0) {
				$records[0]->name = "検索結果はありません。";
			}
			$artistRecord = [
					'name' => $name,
					'records' => $records
			];
		} catch ( Exception $e ) {
			echo $e->getMessage();
		}
    // var_dump($artistRecord);
    $this->assertEquals($records[0]->name, "検索結果はありません。");
  }
}
?>
