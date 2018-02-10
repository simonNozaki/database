<?php

namespace App\Repositories;

use Illuminate\Http\Request;
interface ArtistRepositoryInterface{
  /**
  * 全県取得する。
  */
  public function getAll();

  /**
  *  バンドの情報を登録する。
  * @return $records
  */
  public function inseertArtistData(Request $request);

  /**
  *  名前でバンド名を検索する
  */
  public function getArtistByName(Request $request);

  public function showArtistDetail($name);

  public function insertTitle(Request $request);
}



?>
