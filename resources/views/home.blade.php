@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" action = "/database/search" method= "post">
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="title" class="col-md-4"></label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Start Here" required>

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('title') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <input type = "hidden" name="_token" value="{{csrf_token()}}">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">
                              Search Band's  By Name
                          </button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
