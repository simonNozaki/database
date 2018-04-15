@extends('layouts.app')

@section('content')
@if(Session::has('flash'))
  <p>{{ session('flash') }}</p>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
                    <h3>検索結果</h3>
                </div>
                @guest
                <div class="panel-body">
                  <p>ログインが必要です</p>
                </div>
                @else
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($records) > 0)
                      @foreach($records as $record)
                        <p><a href= "/database/show/{{{ $record->name }}}" >{{ $record->name }}</a></p>
                        <p> {{ $record->area }} </p>
                      @endforeach
                    @else
                        <p>検索結果はありません。</p>
                    @endif
                    <a href = "{{action('HomeController@index')}}" class = "btn-link">トップに戻る。</a>
                </div>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
