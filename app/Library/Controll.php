<?php namespace App\Library;

use App\Plata;
use App\Chitanta;
use File;
use Auth;

class Controll{

  //protected static $plata;

  public static function getPlata($plata){
    //self::$plata = $plata;
    return self::dnn(self::breakCode($plata->cod_nou),$plata);
  }

  public static function breakCode($cod){
    return [
      'codAbonat'=>substr($cod,0,14),
      'nrApel'=>substr($cod,14,10),
      'sumaTotalPlata'=>substr($cod,24,12),
      'scadenta'=>substr($cod,36,8)
    ];
  }

  public static function dnn($code,$p){

    $path = storage_path().'/app/public/dnn/';
    $col = [
      'CodAbonatRtc'=>$code['codAbonat'],
      'SumaPlatita'=>$code['sumaTotalPlata'],
      'DataPlatii'=>implode(explode('-',explode(' ',$p->created_at)[0])),
      'OraPlatii'=>implode(explode(':',explode(' ',$p->created_at)[1])),
      'ModPlata'=>'Conform Anexei 2.a',
      'ObiectPlata'=>'Conform Anexei 2.b',
      'Telefon'=>$code['nrApel'],
      'IdAgentIncasator'=>$p->utilizator
    ];


    $r=null;
    $chitanta = new Chitanta();
    foreach($col as $k=>$v){
        $chitanta->user_id = Auth::user()->id;
        $chitanta->$k = $v;
        $r .= $k.' '.$v."\r\n";
    }
    $chitanta->save();

    $filename = rand(100,999).implode(explode('-',explode(' ',$p->created_at)[0])).'.dnn';
    File::put($path.$filename,$r);
    //dd($filename);

    //dd(Storage::get('/app/public/da.cnn'));
    //File::put($path.'da.cnn','da');
    //return response()->download($path.'da.dnn');
    return [$path.$filename,$r];
  }

  public static function cnn($cod){

  }
}
