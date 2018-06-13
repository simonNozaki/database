<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('artist_master', function (Blueprint $table) {
          $table->increments('artist_id');
          $table->string('name');
          $table->string('category');
          $table->string('area');
          $table->string('for_fans_of_1');
          $table->string('for_fans_of_2')->nullable();
          $table->string('for_fans_of_3')->nullable();
          $table->integer('user_id');
      });

      Schema::create('artist_title', function(Blueprint $table){
          $table->increments('artist_id');
          $table->string('name')->nullable();
          $table->string('title');
          $table->string('released_year')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artist_master');
        Schema::dropIfExists('artist_title');
    }
}
