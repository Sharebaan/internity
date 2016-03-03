<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Scan;

class FacturiController extends Controller
{
  public $scan;

  public function index(){
      return view('facturi');
  }

  public function scan(Request $req){

    $val = Validator::make($req->all(), [
        'cod' => 'numeric|required|min:43',
    ]);
    //dd('da',$val->fails(),strlen($req->cod),$req->cod);
    if($val->fails()){return redirect()->back()->withErrors($val)->withInput();}

    $codAbonat = substr($req->cod,0,14);
    $nrApel = substr($req->cod,14,10);
    $sumaTotalPlata = substr($req->cod,24,12);
    $scadenta = substr($req->cod,36,8);

    $check = Scan::where('cod',$req->cod)->get();

    if($check->isEmpty()){
      $scan = new Scan();
      $scan->cod = $req->cod;
      $scan->cod_abonat = $codAbonat;
      $scan->nr_apel = $nrApel;
      $scan->total_plata = $sumaTotalPlata;
      $scan->data_scadenta = $scadenta;
      $scan->save();

      session()->put('scan',$scan);
      return redirect('/detaliifactura');
    }else{
      session()->put('scan',$check->first());
      return redirect('/detaliifactura');
    }

  }

  public function detaliifactura(){
    return view('detaliifactura');
  }

  public function postdetaliiplata(Request $req){
    //dd($req->all());
    session()->put('detplata',$req->utilizator);
    return redirect('/detaliiplata');
  }

  public function detaliiplata(){
    return view('detaliiplata');
  }

  public function confirmare(){
    return view('confirmare');
  }

  public function postconfirmare(Request $req){
    session()->put('confirmare',$req->suma);
    return redirect('/confirmare');
  }

  public function trimite(Request $req){
    if(!$req->session()->has('scan') && !$req->session()->has('detplata') && !$req->session()->has('confirmare')){
      return redirect('/');
    }

    
  }
}
