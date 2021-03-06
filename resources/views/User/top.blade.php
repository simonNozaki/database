@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{ $userInfos->name }}</h3>
                </div>
                <div class="panel-body">
                  <p>最近投稿したアーティスト</p>
                  <ul class="list-group">
                      @foreach($posted as $record)
                          <li class="list-group-item">{{ $record->name }}</li>
                      @endforeach
                  </ul>
                  <a href = "{{action('HomeController@index')}}"
                    class="btn btn-primary btn-lg btn-block">
                    トップに戻る
                  </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
