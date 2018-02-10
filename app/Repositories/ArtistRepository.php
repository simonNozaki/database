<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Repositories\ArtistRepositoryInterface;


class ArtistRepository implements ArtistRepositoryInterface{

  public function getAll(){
    $records = DB::table('artist_master')->get();
    return $records;
  }

  //バンド情報を登録するメソッド
  public function inseertArtistData(Request $request){
    $name       = $request->input('name');
    $category   = $request->input('category');
    $area       = $request->input('area');
    $forFansOf1 = $request->input('forFansOf1');
    $forFansOf2 = $request->input('forFansOf2');
    $forFansOf3 = $request->input('forFansOf3');
    $userId     = $request->input('userId');

    //バリデーション
    try{
      $request->validate([
          'artist_id'  => ['max:11'],
          'name'       => ['required','unique:artist_master','max:255','regex:/^[0-9a-zA-Z]{20}$/'],
          'category'   => ['required','regex:/^[0-9a-zA-Z]{20}$/'],
          'area'       => ['required','regex:/^[0-9a-zA-Z]{20}$/'],
          'forFansOf1' => ['required','regex:/^[0-9a-zA-Z]{20}$/']
      ]);
    }catch(Exception $e){
      $e->getMessage();
    }

    $artistData = [
      'name'          => $name,
      'category'      => $category,
      'area'          => $area,
      'for_fans_of_1' => $forFansOf1,
      'for_fans_of_2' => $forFansOf2,
      'for_fans_of_3' => $forFansOf3,
      'user_id'       => $userId
    ];

    try{
      DB::table('artist_master')->insertGetId($artistData);
    }catch(Exception $e){
      $e->getMessage();
    }

  }

  public function getArtistByName(Request $request){
    $name = $request->input('name');
    $records = DB::table('artist_master')
          ->where('name', 'like', "%{$name}%")
          ->get();
    if(empty($records)){
      $records = "Nothing is searched";
    }
    $artistRecord = [
      'name' => $name,
      'records' => $records];
    return $artistRecord;
  }

  public function showArtistDetail($name){
    $artistName = DB::table('artist_base.artist_master')->where('name', 'like', "%{$name}%")
          ->first();
    $artistTitles = DB::table('artist_base.artist_master')
          ->select('*')
          ->leftjoin('artist_base.artist_title', 'artist_master.artist_id', '=', 'artist_title.artist_id')
          ->where('artist_title.artist_id', '=', "{$artistName->artist_id}")
          ->get();
    $artistData = [
      'artistName' => $artistName,
      'artistTitles' => $artistTitles
    ];
    return $artistData;
  }

  public function insertTitle(Request $request){
    $artistId     = $request->input('artistId');
    $name         = $request->input('name');
    $title        = $request->input('title');
    $releasedYear = $request->input('releasedYear');

    $request->validate([
      'artistId'     => ['required'],
      'title'        => ['required','unique:artist_title', 'regex:/^[0-9a-zA-Z]{20}$/'],
      'name'         => ['required','regex:/^[0-9a-zA-Z]{20}$/'],
      'releasedYear' => ['required','regex:/^[0-9a-zA-Z]{20}$/']
    ]);

    try{
      DB::table('artist_base.artist_title')
            ->insert([
              'artist_id'     => $artistId,
              'title'         => $title,
              'name'          => $name,
              'released_year' => $releasedYear
            ]);
      $artistName = [ 'name' => $name];
      return $artistName;
    }
    catch(Exception $e){
       $e->getMessage();
    }
  }

}

?>
