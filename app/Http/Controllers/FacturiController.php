<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Scan;
use App\Plata;
use App\Library\FormatData;
use App\Library\Misc;
use App\Library\Controll;

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

    if($val->fails()){return redirect()->back()->withErrors($val)->withInput();}

    Misc::getCode($req);
    //dd(session()->has('price'));
    return redirect('/detaliifactura');


  }

  public function confirmare(){
    session()->put(['price'=>FormatData::price(ltrim(session()->get('scan')->total_plata,0))]);
    session()->put(['date'=>FormatData::date(session()->get('scan')->data_scadenta)]);
    return view('confirmare');
  }

  public function postconfirmare(Request $req){
    $val = Validator::make($req->all(),['suma'=>'numeric']);
    //dd($val);
    if($val->fails()){return redirect()->back()->withErrors($val)->withInput();}
    session()->put('confirmare',$req->suma);
    return redirect('/confirmare');
  }

  public function trimite(Request $req){
    if(!$req->session()->has('scan') && !$req->session()->has('price') && !$req->session()->has('date') && !$req->session()->has('confirmare')){
      return redirect('/');
    }


    //return response()->download(Controll::getPlata(Misc::send($req,1))[0]);
    Controll::getPlata(Misc::send($req,1));
    return redirect('/')->with('thankyou','1');

  }
}
