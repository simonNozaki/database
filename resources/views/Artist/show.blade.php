@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="text-align:center;">{{ $artistName->name }}</h3>
                    <p>Category: {{ $artistName->category }}</p>
                    <p>Area: {{ $artistName->area }}</p>
                    <p>For fans of...</p>
                    <ul>
                        <li><p>{{ $artistName->for_fans_of_1 }}</p></li>
                        @if(isset($artistName->for_fans_of_2))
                        <li><p>{{ $artistName->for_fans_of_2 }}</p></li>
                        @endif
                        @if(isset($artistName->for_fans_of_3))
                        <li><p>{{ $artistName->for_fans_of_3 }}</p></li>
                        @endif
                    </ul>
                </div>

                <div class="panel-body">
                  @if(isset($artistTitles))
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
                  <ul>
                      <li><a href = "/database/{{{ $artistName->name }}}/registerTitle" class = "btn-link">Register Title</a>
                      @endguest
                      <li><a href = "/database/index" class = "btn-link">Back to index</a>
                  <ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
