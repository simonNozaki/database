<?php

namespace App\Service;

use App\Artist;

public class ArtistMasterService implements ArtistMasterServiceInterface{

  public class getAll(){
    $records = Artist::all();
    return $records;
  }

}

?>
