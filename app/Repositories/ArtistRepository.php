<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;
use App\Repositories\ArtistRepositoryInterface;
use App\Constants\CodeDefine;

class ArtistRepository implements ArtistRepositoryInterface {
	public function getAll() {
		$cd = new CodeDefine();
		try{
			$records = DB::table ( 'artist_master' )->get ();
			return $records;
		}catch(Exception $e){
			Log::error($cd->EXE_ERR);
			echo $e->getMessage();
		}
	}

	// バンド情報を登録するメソッド
	public function inseertArtistData(Request $request) {
		$name = $request->input ( 'name' );
		$category = $request->input ( 'category' );
		$area = $request->input ( 'area' );
		$forFansOf1 = $request->input ( 'forFansOf1' );
		$forFansOf2 = $request->input ( 'forFansOf2' );
		$forFansOf3 = $request->input ( 'forFansOf3' );
		$userId = $request->input ( 'userId' );

    // CodeDefine
		$cd = new CodeDefine();

		// バリデーション
		try {
			$request->validate ( [
					'artist_id' => [
							'max:11'
					],
					'name' => [
							'required',
							'unique:artist_master',
							'max:255',
							'regex:/[0-9a-zA-Zぁ-んァ-ヶー一-龠!-@]+/'
					],
					'category' => [
							'required',
							'regex:/[0-9a-zA-Zぁ-んァ-ヶー一-龠!-@]+/'
					],
					'area' => [
							'required',
							'regex:/[0-9a-zA-Zぁ-んァ-ヶー一-龠!-@]+/'
					],
					'forFansOf1' => [
							'required',
							'regex:/[0-9a-zA-Zぁ-んァ-ヶー一-龠!-@]+/'
					]
			] );
		} catch ( Exception $e ) {
			Log::error($cd->EXE_ERR);
			echo $e->getMessage();
		}

		$artistData = [
				'name' => $name,
				'category' => $category,
				'area' => $area,
				'for_fans_of_1' => $forFansOf1,
				'for_fans_of_2' => $forFansOf2,
				'for_fans_of_3' => $forFansOf3,
				'user_id' => $userId
		];

		try {
			DB::table ( 'artist_master' )->insertGetId ( $artistData );
		} catch ( Exception $e ) {
			Log::error($cd->EXE_ERR);
			echo $e->getMessage();
		}
	}
	public function getArtistByName(Request $request) {
		// CodeDefine
		$cd = new CodeDefine();
		$name = $request->input ( 'name' );
		$request->validate ( [
				'name' => [
						'required',
						'unique:artist_master',
						'max:255',
						'regex:/[0-9a-zA-Zぁ-んァ-ヶー一-龠!-@]+/'
				]
		] );
		try {
			$records = DB::table ( 'artist_master' )->where ( 'name', 'like', "%{$name}%" )->get ();
			if (count ( $records ) == 0) {
				$records[0]->name = "検索結果はありません。";
			}
			$artistRecord = [
					'name' => $name,
					'records' => $records
			];
			return $artistRecord;
		} catch ( Exception $e ) {
			echo $e->getMessage();
		}
	}

	public function showArtistDetail($name) {
		// CodeDefine
		$cd = new CodeDefine();
		try {
			$artistName = DB::table ( 'artist_base.artist_master' )->where ( 'name', 'like', "%{$name}%" )->first ();
			$artistTitles = DB::table ( 'artist_base.artist_master' )->select ( '*' )->leftjoin ( 'artist_base.artist_title', 'artist_master.artist_id', '=', 'artist_title.artist_id' )->where ( 'artist_title.artist_id', '=', "{$artistName->artist_id}" )->get ();
			$artistData = [
					'artistName' => $artistName,
					'artistTitles' => $artistTitles
			];
			return $artistData;
		} catch ( Exception $e ) {
			echo $e->getMessage();
		}
	}

	public function insertTitle(Request $request) {
		$artistId = $request->input ( 'artistId' );
		$name = $request->input ( 'name' );
		$title = $request->input ( 'title' );
		$releasedYear = $request->input ( 'releasedYear' );
		// CodeDefine
		$cd = new CodeDefine();

		$request->validate ( [
				'artistId' => [
						'required'
				],
				'title' => [
						'required',
						'unique:artist_title',
						'regex:/[0-9a-zA-Zぁ-んァ-ヶー一-龠!-@]+/'
				],
				'name' => [
						'required',
						'regex:/[0-9a-zA-Zぁ-んァ-ヶー一-龠!-@]+/'
				],
				'releasedYear' => [
						'required',
						'regex:/[0-9a-zA-Zぁ-んァ-ヶー一-龠!-@]+/'
				]
		] );

		try {
			DB::table ( 'artist_base.artist_title' )->insert ( [
					'artist_id' => $artistId,
					'title' => $title,
					'name' => $name,
					'released_year' => $releasedYear
			] );
			$artistName = [
					'name' => $name
			];
			return $artistName;
		} catch ( Exception $e ) {
			Log::error($cd->EXE_ERR);
			echo $e->getMessage();
		}
	}

  public function deleteArtist($artistId){
    $cd = new CodeDefine();
		try{
			DB::table('artist_base.artist_master')->where('artist_id','=',"%{$artistId}%")->delete();
		}catch(Exception $e){
			Log::error($cd->EXE_ERR);
			echo $e->getMessage();
		}
	}

}

?>
