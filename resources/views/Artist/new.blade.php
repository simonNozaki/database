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
                <div class="panel-heading">Tell me your favorite bands!</div>
                @guest
                <div class="panel-body">
                  <p>ログインが必要です</p>
                </div>
                @else
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ action('ArtistController@store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="category" value="{{ old('category') }}" required>

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Area</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="area" required>

                                @if ($errors->has('area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('forFansOf1') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">For Fans Of, 1</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="forFansOf1" required>

                                @if ($errors->has('forFansOf1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('forFansOf1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">For Fans Of, 2</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="forFansOf2">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">For Fans Of, 3</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="forFansOf3">
                            </div>
                        </div>

                        <input type = "hidden" name = "userId" value = "{{ Auth::user()->id }}">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
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
