<?php namespace App\Library;

use Illuminate\Http\Request;
use App\Scan;
use App\Plata;

class Misc {

  public static function getCode($req){
    $codAbonat = substr($req->cod,0,14);
    $nrApel = substr($req->cod,14,10);
    $sumaTotalPlata = substr($req->cod,24,12);
    $scadenta = substr($req->cod,36,8);

    $check = Scan::where('cod',$req->cod)->get();

    self::checkEmpty($check,$req->cod,$codAbonat,
            $nrApel,$sumaTotalPlata,$scadenta);
  }

  public static function checkEmpty($check,$cod,$codAbonat,
                              $nrApel,$sumaTotalPlata,$scadenta){
    switch ($check) {
      case $check->isEmpty():
          $scan = new Scan();
          $scan->cod = $cod;
          $scan->cod_abonat = $codAbonat;
          $scan->nr_apel = $nrApel;
          $scan->total_plata = $sumaTotalPlata;
          $scan->data_scadenta = $scadenta;
          $scan->save();

          session()->put('scan',$scan);
        break;

      default:
          session()->put('scan',$check->first());
        break;
    }
    self::format();
  }

  public static function format(){
    session()->put(['price'=>FormatData::price(ltrim(session()->get('scan')->total_plata,0))]);
    session()->put(['date'=>FormatData::date(session()->get('scan')->data_scadenta)]);
  }


  public static function send($req,$for){
    //dd($req->session()->get('price'),$req->session()->get('confirmare'));
    $suma = $for == 1 ? $req->session()->get('price') : $req->session()->get('confirmare');

    $utilizator = $for == 1 ? "" : $req->session()->get('detplata');
    $restzero = strlen($req->session()->get('scan')->total_plata) - strlen(str_replace('.','',str_replace(',','',$suma)));
    $zero = null;

    for($i=0;$i<$restzero;$i++){
      $zero.=0;
    }

    $sumacod = $zero.str_replace('.','',str_replace(',','',$suma));
    $codnou = $req->session()->get('scan')->cod_abonat.$req->session()->get('scan')->nr_apel.
              $sumacod.$req->session()->get('scan')->data_scadenta;

    $plata = new Plata();
    $plata->scan_id = $req->session()->get('scan')->id;
    $plata->utilizator = $utilizator;
    $plata->suma = $suma;
    $plata->cod_nou = $codnou;
    $plata->save();

    return $plata;
  }



}
