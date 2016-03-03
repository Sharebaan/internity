@extends('layouts.app')
@section('title','Confirmare')
@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">Confirmare</div>

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
                               <td>{{Session::get('scan')->total_plata}}</td>
                             </tr>
                             <tr>
                               <th>DataScadenta</th>
                               <td>{{Session::get('scan')->data_scadenta}}</td>
                             </tr>
                             <tr>
                               <th>Utilizator</th>
                               <td>{{Session::get('detplata')}}</td>
                             </tr>
                             <tr>
                               <th>Confirmare</th>
                               <td>{{Session::get('confirmare')}}</td>
                             </tr>
                           </table>
                        </div>

                      </div>


                      <div class="row">

                          <a href="/trimite" type="button" class="col-md-4 col-md-offset-4 btn btn-default">Trimite</a>


                        </div>


                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
