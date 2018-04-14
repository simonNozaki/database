@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  お気に入りのアーティストを教えてください！For fans ofは、一つは必須入力です。
                </div>
                @guest
                <div class="panel-body">
                  <p>ログインが必要です</p>
                </div>
                @else
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ action('ArtistController@store') }}">
                        {{ csrf_field() }}

                        <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="input-field col s12">
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" required autofocus placeholder="アーティスト名を入力">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <div class="col input-field s12">
                                <input id="email" type="text" class="form-control" name="category"
                                    value="{{ old('category') }}" required placeholder="ジャンルを入力">

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                            <div class="input-field col s12">
                                <input id="password" type="text" class="form-control"
                                    name="area" required placeholder="地域を入力">

                                @if ($errors->has('area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('forFansOf1') ? ' has-error' : '' }}">
                            <div class="col input-field s12">
                                <input type="text" class="form-control" name="forFansOf1" placeholder="For fans of ...">
                                @if ($errors->has('forFansOf1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('forFansOf1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col input-field s12">
                                <input type="text" class="form-control" name="forFansOf2" placeholder="For fans of ...">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col input-field s12">
                                <input type="text" class="form-control" name="forFansOf3" placeholder="For fans of ...">
                            </div>
                        </div>

                        <input type = "hidden" name = "userId" value = "{{ Auth::user()->id }}">

                        <div class="form-group">
                            <div class="col col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register Band
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
