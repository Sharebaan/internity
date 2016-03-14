@extends('layouts.app')
@section('title','Acasa')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">Metoda plata</div>
            <div class="panel-body" style="text-align:center;">
            @if(Session::has('thankyou'))
              <h1>Multumesc pentru factura depusa.</h1>
            @else
              <div class="row ">
                  <a href="/platafacturi" type="button" class="btn btn-primary col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">Facturi</a>
              </div>
              <br>
              <div class="row ">
                  <a href="/depozite" type="button" class="btn btn-primary col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">Depozite</a>
              </div>
            @endif
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
