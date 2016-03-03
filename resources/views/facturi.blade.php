@extends('layouts.app')
@section('title','Facturi')
@section('content')

  <div class="container">
      <div class="row"  style="text-align:center;">
          <h1 class="">Scaneaza factura</h1>
          <img src="/public/gif/scangif.gif" alt="" class="img col-md-6 col-md-offset-3"/>
          <form class="" id="codform" method="post" action="/platafacturi" autocomplete="off">
              <input type="text" class="hid" onblur="this.focus()" autofocus name="cod">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
          </form>
      </div>
  </div>

@endsection
