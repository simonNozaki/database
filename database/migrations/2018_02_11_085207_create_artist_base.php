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
      Schema::connection('artist_base')->create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('email')->unique();
          $table->string('password');
          $table->rememberToken();
          $table->timestamps();
      });

      Schema::connection('artist_base')->create('password_resets', function (Blueprint $table) {
          $table->string('email')->index();
          $table->string('token');
          $table->timestamp('created_at')->nullable();
      });

      Schema::connection('artist_base')->create('artist_master', function (Blueprint $table) {
          $table->increments('artist_id')->primary();
          $table->string('name');
          $table->string('category');
          $table->string('area');
          $table->string('for_fans_of_1');
          $table->string('for_fans_of_2')->nullable();
          $table->string('for_fans_of_3')->nullable();
          $table->integer('user_id');
      });

      Schema::connection('artist_base')->create('artist_title', function(Blueprint $table){
          $table->integer('artist_id');
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
        //
    }
}
