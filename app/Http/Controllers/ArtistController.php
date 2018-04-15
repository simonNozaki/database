<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ArtistRepositoryInterface;

class ArtistController extends Controller{

  /**
  *  ArtistRepositoryのコンストラクタ。
  */
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
    //インサートしたレコードのバンド情報を受け取る
    $artistName = $this->artistRepository->insertTitle($request)['name'];
    $request->session()->flash('flash', 'Title Registered');
    return redirect()->to("database/show/{$artistName}");
  }

  public function titleForm($name){
    $artistData = $this->artistRepository->showArtistDetail($name);
    $artistName = $artistData['artistName'];
    return view('Artist.title', compact('artistName'));
  }

  public function deleteArtist($artistId){
    $this->artistRepository->deleteArtist($artistId);
    return redirect()->to("database/index");
  }

}

?>
