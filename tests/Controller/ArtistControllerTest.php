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
                  ->type('name','FABLED NUMBER')->type('category','ROCK ')->type('area','大阪')->type('forFansOf1','NOISE MAKER')
                  ->assertPathIs('database/index');
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
                  ->visit('home')
                  ->type('name','aaa')
                  ->assertPathIs('database/search')
                  ->assertSee('検索結果はありません。');
        });
      }catch(Exception $e){
        $cd = new CodeDefine();
        Log::error($cd->EXE_ERR);
        throw new Exception();
      }
    }
}
