<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Artist;
use Illuminate\Support\Facades\DB;
use Input;
use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ArtistController extends Controller{

  public function index(){
    $records = Artist::all();
    return view('Artist.index', compact('records'));
  }

  public function new(){
    return view('Artist.new');
  }

  public function store(Request $request){
    //バンド情報の登録
    $name = $request->input('name');
    $category = $request->input('category');
    $area = $request->input('area');
    $forFansOf1 = $request->input('forFansOf1');
    $forFansOf2 = $request->input('forFansOf2');
    $forFansOf3 = $request->input('forFansOf3');
    $userId = $request->input('userId');

    //バリデーション
    $this->validate($request, [
        'artist_id' => 'max:11',
        'name' => 'required|unique:artist_master|max:255',
        'category' => 'required',
        'area' => 'required',
        'forFansOf1' => 'required'
    ]);

    $data = ['name' => $name, 'category' => $category, 'area' => $area, 'for_fans_of_1' => $forFansOf1, 'for_fans_of_2' => $forFansOf2, 'for_fans_of_3' => $forFansOf3, 'user_id' => $userId];

    DB::table('artist_master')->insertGetId($data);
    $request->session()->flash('flash', 'Artist Registered');
    return redirect()->to('/database/index');
  }

  public function search(Request $request){
    $name = $request->input('name');
    $records = DB::table('artist_master')
          ->where('name', 'like', "%{$name}%")
          ->get();
    if(empty($records)){
      $records = "Nothing is searched";
    }
    return view('Artist.search', compact('records', 'name'));
  }

  public function show($name){
    $record = DB::table('artist_base.artist_master')
          ->where('name', 'like', "%{$name}%")
          ->first();
    $artistTitles = DB::table('artist_base.artist_master')
          ->select('*')
          ->leftjoin('artist_base.artist_title', 'artist_master.artist_id', '=', 'artist_title.artist_id')
          ->where('artist_title.artist_id', '=', "{$record->artist_id}")
          ->get();
    return view('Artist.show', compact('record', 'artistTitles'));
  }

  public function storeTitles(Request $request){
    $artistId = $request->input('artistId');
    $name = $request->input('name');
    $title = $request->input('title');
    $releasedYear = $request->input('releasedYear');

    $this->validate($request, [
      'artistId' => 'required',
      'title' => 'required|unique:artist_title',
      'name' => 'required',
      'releasedYear' => 'required'
    ]);

    try{
      DB::table('artist_base.artist_title')
            ->insert([ 'artist_id' => $artistId, 'title' => $title, 'name' => $name, 'released_year' => $releasedYear ]);
      $request->session()->flash('flash', 'Title Registered');
      return redirect()->to('database/show/{name}');
    }
    catch(Exception $e){
       $e->getMessage();
    }
  }

}

?>
