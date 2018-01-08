@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Bands Index<h3></div>

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
                      <p><a href= "/database/show/{{{ $record->name }}}" >{{ $record->name }}</a></p>
                      <p> {{ $record->area }} </p>
                    @endforeach

                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
