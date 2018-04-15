@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="text-align:center;">{{ $artistName->name }}</h3>
                    <p>ジャンル： {{ $artistName->category }}</p>
                    <p>地域： {{ $artistName->area }}</p>
                    <p>For fans of...</p>
                    <ul class="collection">
                        <li class="collection-item">{{ $artistName->for_fans_of_1 }}</li>
                        @if(isset($artistName->for_fans_of_2))
                        <li class="collection-item">{{ $artistName->for_fans_of_2 }}</li>
                        @endif
                        @if(isset($artistName->for_fans_of_3))
                        <li class="collection-item">{{ $artistName->for_fans_of_3 }}</li>
                        @endif
                    </ul>
                </div>

                <div class="panel-body">
                  @if(isset($artistTitles))
                  <p>アーティストタイトル</p>
                  <ul class="list-group">
                    @foreach($artistTitles as $artistTitle)
                      <li class="list-group-item">{{ $artistTitle->title }} : {{ $artistTitle->released_year }}</li>
                    @endforeach
                  </ul>
                  @else
                  <p>No Titles Registered. Please Tell Us Titles?</p>
                  @endif
                  @guest
                  <p>アルバムの登録には、ログインが必要です。</p>
                  @else
                    <a href = "/database/{{{ $artistName->name }}}/registerTitle"
                        class="btn btn-primary btn-lg btn-block">
                        タイトルを登録する
                    </a>
                    @endguest
                    <a href = "/database/index" class="btn btn-primary btn-lg btn-block">
                      アーティスト一覧に戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
