@extends('layouts.app')
@section('title','Acasa')
@section('content')
<div class="container">
    <div class="row">
        <div class="facdep col-md-10 col-md-offset-1">
            <div class="row ">
                <a href="/platafacturi" type="button" class="btn btn-default col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">Facturi</a>
            </div>
            <br>
            <div class="row ">
                <a href="/depozite" type="button" class="btn btn-default col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">Depozite</a>
            </div>
        </div>
    </div>
</div>
@endsection
