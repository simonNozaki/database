<?php

namespace App\Repositories;

use App\Models\Artist;
use App\Repositories\ArtistRepositoryInterface;


class ArtistRepository implements ArtistRepositoryInterface{

  public function getAll(){
    $records = Artist::all();
    return $records;
  }

}

?>
