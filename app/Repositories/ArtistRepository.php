<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\ArtistRepositoryInterface;


class ArtistRepository implements ArtistRepositoryInterface{

  public function getAll(){
    $records = DB::table('artist_master')->get();
    return $records;
  }

}

?>
