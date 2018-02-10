<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Support\Facades\DB;
use Input;
use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Repositories\ArtistRepositoryInterface;
use App\Repositories\ArtistRepository;

class ArtistController extends Controller{

  public function __construct(ArtistRepositoryInterface $artistRepository){
    $this->artistRepository = $artistRepository;
  }

  public function index(){
    //全件取得する
    $records = $this->artistRepository->getAll();
    return view('Artist.index', compact('records'));
  }

  public function new(){
    return view('Artist.new');
  }

  public function store(Request $request){
    //バンドデータの挿入
    $this->artistRepository->inseertArtistData($request);
    //フラッシュメッセージの表示
    $request->session()->flash('flash', 'Artist Registered');
    return redirect()->to('/database/index');
  }

  public function search(Request $request){
    //名前でレコードを取得する
    $artistRecord = $this->artistRepository->getArtistByName($request);
    $name = $artistRecord['name'];
    $records = $artistRecord['records'];
    return view('Artist.search', compact('records', 'name'));
  }

  public function show($name){
    //バンド名に紐付くタイトルとバンド名の連想配列を取得する
    $artistData = $this->artistRepository->showArtistDetail($name);
    //変数を取り出して、戻り値に渡す
    $artistName = $artistData['artistName'];
    $artistTitles = $artistData['artistTitles'];
    return view('Artist.show', compact('artistName', 'artistTitles'));
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
