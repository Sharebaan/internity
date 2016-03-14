<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Chitanta;
use App\Plata;
use Excel;
use Auth;

class ChitanteController extends Controller
{
  public function index(){

    return view('chitante')->with('c',Chitanta::where('user_id',auth()->user()->id)->with('user')->orderBy('created_at','DESC')->paginate(20));
  }

  public function generateChitanta(Request $req){
      $d = Chitanta::find($req->id)->toArray();



      $pdf = Excel::create($d['OraPlatii'], function($excel) use($d) {

          $excel->sheet($d['OraPlatii'], function($sheet) use($d) {
            $sheet->cell(function($cells) {

                $cells->setBorder('solid', 'none', 'none', 'solid');

            });
              $sheet->setFontSize(28);

              $sheet->row(1, [
                   'CodAbonatRtc', $d['CodAbonatRtc']
              ]);
              $sheet->row(2, [
                   'SumaPlatita', $d['SumaPlatita']
              ]);
              $sheet->row(3, [
                   'DataPlatii', $d['DataPlatii']
              ]);
              $sheet->row(4, [
                   'OraPlatii', $d['OraPlatii']
              ]);
              $sheet->row(5, [
                   'ModPlata', $d['ModPlata']
              ]);
              $sheet->row(6, [
                   'ObiectPlata', $d['ObiectPlata']
              ]);
              $sheet->row(7, [
                   'Telefon', $d['Telefon']
              ]);
              $sheet->row(8, [
                   'IdAgentIncasator', $d['IdAgentIncasator']
              ]);
          });

      })->store('pdf',storage_path('exports'));

      return response()->make(file_get_contents(storage_path('exports').'/'.$pdf->filename.'.pdf'),200,[
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; '.$pdf->filename.'.pdf',
      ]);
  }

  public function rangeChitanta(Request $req){
    $f = explode('/',$req->f);
    $l = explode('/',$req->l);
    $newf = $f[2].$f[0].$f[1];
    $newl = $l[2].$l[0].$l[1];
    //dd($newf,$newl);
    $c = Chitanta::with('user')->where('user_id',auth()->user()->id)
    ->whereBetween('DataPlatii',[$newf,$newl])
    ->orderBy('created_at','DESC')->paginate(20);


    return view('chitante')->with('c',$c);
  }

  public function searchChitanta(Request $req){

    $c = Chitanta::search($req->plata)->where('user_id',auth()->user()->id)->with('user')->orderBy('created_at','DESC')->paginate(20);

    return view('chitante')->with('c',$c);
  }
}
