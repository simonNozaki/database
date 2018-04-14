@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
                    <h3>アーティスト一覧<h3>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Session::has('flash'))
                      <p>{{ session('flash') }}</p>
                    @endif

                    @guest
                    <p>閲覧には、ログインが必要です。</p>
                    @else

                    @foreach($records as $record)
                    <div class="collection">
                        <a href="/database/show/{{{ $record->name }}}" class="collection-item">
                            <span class="badge">{{ $record->area }}</span>
                            {{ $record->name }}
                        </a>
                    </div>
                    @endforeach

                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
