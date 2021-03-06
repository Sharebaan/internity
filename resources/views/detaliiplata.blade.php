@extends('layouts.app')
@section('title','Detalii Plata')
@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">Detalii plata</div>

                  <div class="panel-body">
                      <div class="row">

                          <div class="table-responsive col-md-4 col-md-offset-4" style="border:none;">
                           <table class="table table-small-font  table-striped table-hover">
                             <tr>
                               <th>CodAbonat</th>
                               <td>{{Session::get('scan')->cod_abonat}}</td>
                             </tr>
                             <tr>
                               <th>Nr Apel</th>
                                <td>{{Session::get('scan')->nr_apel}}</td>
                             </tr>
                             <tr>
                               <th>TotalPlata</th>
                               <td>{{Session::get('price')}}</td>
                             </tr>
                             <tr>
                               <th>DataScadenta</th>
                               <td>{{Session::get('date')}}</td>
                             </tr>
                             <tr>
                               <th>Utilizator</th>
                               <td>{{Session::get('detplata')}}</td>
                             </tr>
                           </table>
                        </div>

                      </div>


                      <div class="row">


                          <form class="col-md-4 col-md-offset-4" method="post" action="/confirmaredepozit" autocomplete="off">

                                <input type="text" name="suma" class="form-control" autofocus placeholder="Introdu suma">
                                @if ($errors->has('suma'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('suma') }}</strong>
                                    </span>
                                @endif
                                <input type="submit" class="form-control btn btn-primary" value="Valideaza">

                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                          </form>

                        </div>


                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
