<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Library\Misc;
use App\Library\FormatData;
use App\Library\Controll;

use App\Http\Requests;

class DepoziteController extends Controller
{
  public function index(){
      return view('depozite');
  }

  public function cod(Request $req){
    $val = Validator::make($req->all(), [
        'cod' => 'digits_between:44,44|numeric|required',
    ]);

    if($val->fails()){return redirect()->back()->withErrors($val)->withInput();}

    Misc::getCode($req);
    return redirect('/detaliifactura');
  }

  public function detaliifactura(){
    return view('detaliifactura');
  }

  public function postdetaliiplata(Request $req){
    session()->put('detplata',$req->utilizator);
    return redirect('/detaliiplata');
  }

  public function detaliiplata(){
    return view('detaliiplata');
  }

  public function confirmare(){
    session()->put(['price'=>FormatData::price(ltrim(session()->get('scan')->total_plata,0))]);
    session()->put(['date'=>FormatData::date(session()->get('scan')->data_scadenta)]);
    return view('confirmaredepozit');
  }

  public function postconfirmare(Request $req){
    $val = Validator::make($req->all(),['suma'=>'numeric']);
    if($val->fails()){return redirect()->back()->withErrors($val)->withInput();}
    session()->put('confirmare',$req->suma);
    return redirect('/confirmaredepozit');
  }

  public function trimite(Request $req){
    if(!$req->session()->has('scan') && !$req->session()->has('price') && !$req->session()->has('date')
    && !$req->session()->has('detplata') && !$req->session()->has('confirmare')){
      return redirect('/');
    }

    //Misc::send($req,2);
    Controll::getPlata(Misc::send($req,2));
    return redirect('/')->with('thankyou','1');
  }
}
