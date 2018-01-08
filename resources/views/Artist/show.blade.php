@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{ $record->name }}</h3></div>

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
                    <form class="form-horizontal" method="POST" action="{{ action('ArtistController@storeTitles') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('releasedYear') ? ' has-error' : '' }}">
                            <label for="releasedYear" class="col-md-4 control-label">Released Year</label>

                            <div class="col-md-6">
                                <input id="releasedYear" type="text" class="form-control" name="releasedYear" value="{{ old('releasedYear') }}" required>

                                @if ($errors->has('releasedYear'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('releasedYear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type = "hidden" name = "artistId" value = "{{ $record->artist_id }}">
                        <input type = "hidden" name = "name" value = "{{ $record->name }}">
                        <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register The Title
                                </button>
                            </div>
                        </div>
                    </form>
                    @endguest
                    <a href = "{{action('HomeController@index')}}" class = "btn-link">Back to top</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
