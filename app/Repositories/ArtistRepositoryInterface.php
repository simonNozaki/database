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

  /**
   * アーティストの詳細情報を取得、表示する
   * @param $name
   */
  public function showArtistDetail($name);

  /**
   * アーティストのアルバムを登録する
   * @param Request $request
   */
  public function insertTitle(Request $request);

  /**
   * アーティストのレコードを削除する
   * @param $artistId
   */
  public function deleteArtist($artistId);
}



?>
