<?php

namespace Tests\Controller;

use Tests\DuskTestCase;
use App\Constants\CodeDefine;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Log;
use DB;
use App\User;

class ArtistControllerTest extends DuskTestCase{

    public function template(){
      try{
        $this->browse(function ($browser){

        });
      }catch(Exception $e){
        $cd = new CodeDefine();
        Log::error($cd->EXE_ERR);
        throw new Exception();
      }
    }

    /**
    * @test
    * ユーザ認証チェック
    */
    public function normalLogin(){
      $this->browse(function ($browser){
        $browser->visit('login')
                ->clickLink('Log in with Github')
                ->type('name','simonNozaki')
                ->type('password','21405apple')
                ->assertPathIs('home');
      });
    }

    /**  @test */
    public function index_Case1(){
      $cd = new CodeDefine();
      try{
        $this->browse(function($browser){
          $browser->loginAs(User::find(1))
                  ->visit('database/index')
                  ->assertSee('THREE LIGHTS DOWN KINGS');
        });
      }catch(Exception $e){
        Log::error($cd->EXE_ERR);
    	  throw new Exception();
      }
    }

    // 空の入力値チェック
    /** @test */
    public function new_Case1(){
      try{
        $this->browse(function ($browser){
          $browser->loginAs(User::find(1))
                  ->visit('database/new')
                  ->type('name','')->type('category','')->type('area','')->type('forFansOf1','')
                  ->assertPathIs('/database/new');
        });
      }catch(Exception $e){
        $cd = new CodeDefine();
        Log::error($cd->EXE_ERR);
    	  throw new Exception();
      }
    }

    // 特殊文字のValidationチェック
    /** @test */
    public function new_Case2(){
      try{
        $this->browse(function ($browser){
          $browser->loginAs(User::find(1))
                  ->visit('database/new')
                  ->type('name','///')->type('category','...')->type('area','+++')->type('forFansOf1',']]]')
                  ->assertPathIs('/database/new');
        });
      }catch(Exception $e){
        $cd = new CodeDefine();
        Log::error($cd->EXE_ERR);
    	  throw new Exception();
      }
    }

    // 正常な値の入力チェック
    /** @test */
    public function new_Case3(){
      try{
        $this->browse(function ($browser){
          $browser->loginAs(User::find(1))
                  ->visit('database/new')
                  ->type('name','FABLED NUMBER')->type('category','ROCK ')
                  ->type('area','大阪')->type('forFansOf1','NOISE MAKER')
                  ->press('登録する')
                  ->assertPathIs('database/index')
                  ->assertSee('NOISE MAKER');
        });
      }catch(Exception $e){
        $cd = new CodeDefine();
        Log::error($cd->EXE_ERR);
    	  throw new Exception();
      }
    }

    // 検索結果が0件だった時の挙動確認
    /** @test */
    public function search_Case1(){
      try{
        $this->browse(function ($browser){
          $browser->loginAs(User::find(1))
                  ->visit('/home')
                  ->type('name','aaa')
                  ->press('SEARCH')
                  ->assertPathIs('/database/search')
                  ->assertSee('検索結果はありません。');
        });
      }catch(Exception $e){
        $cd = new CodeDefine();
        Log::error($cd->EXE_ERR);
        throw new Exception();
      }
    }

    // 正常稼働チェック
    /** @test */
    public function search_Case2(){
      try{
        $this->browse(function ($browser){
          $browser->loginAs(User::find(1))
                  ->visit('home')
                  ->type('name','three')
                  ->press('SEARCH')
                  ->assertPathIs('database/search')
                  ->assertSee('THREE LIGHTS DOWN KINGS');
        });
      }catch(Exception $e){
        $cd = new CodeDefine();
        Log::error($cd->EXE_ERR);
        throw new Exception();
      }
    }

    /** @test */
    public function deleteArtist_Case1(){
      try{
        $this->browse(function ($browser){
          $browser->loginAs(User::find(1))
                  ->visit('/database/show/FABLED%20NUMBER')
                  ->clickLink('このアーティストを削除する')
                  ->assertPathIs('database/index');
        });
      }catch(Exception $e){
        $cd = new CodeDefine();
        Log::error($cd->EXE_ERR);
        throw new Exception();
      }
    }

    // 空の文字列を処理できないことを確認する
    /** @test */
    public function insertTitle_Case1(){
      try{
        $this->browse(function ($browser){
          $browser->loginAs(User::find(1))
                  ->visit('database/THREE%20LIGHTS%20DOWN%20KINGS/registerTitle')
                  ->type('title','')
                  ->type('releasedYear','')
                  ->press('登録する')
                  ->assertPathIs('database/show/FABLED%20NUMBER/registerTitle');
        });
      }catch(Exception $e){
        $cd = new CodeDefine();
        Log::error($cd->EXE_ERR);
        throw new Exception();
      }
    }
}
