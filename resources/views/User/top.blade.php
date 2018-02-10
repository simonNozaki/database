@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{ $userInfos->name }}</h3></div>

                <div class="panel-body">
                  <ul class="list-group">

                  </ul>
                  <a href = "{{action('HomeController@index')}}" class = "btn-link">Back to top</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
