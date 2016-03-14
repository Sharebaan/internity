@extends('layouts.app')
@section('title','Depozite')
@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">Depozite</div>

                  <div class="panel-body">
                    <form class="scan col-md-12" action="/depozite" method="post">
                      <input type="text" name="cod" value="" placeholder="Introdu codul" autofocus>
                      <br>
                      @if ($errors->has('cod'))
                        <div class="alert alert-danger col-md-10 col-md-offset-1" role="alert">
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          <strong>{{ $errors->first('cod') }}</strong>
                        </div>
                      @endif
                      <input type="submit" class="btn btn-primary col-md-10 col-md-offset-1" value="Adauga">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
