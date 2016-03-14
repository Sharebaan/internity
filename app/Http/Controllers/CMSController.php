<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Chitanta;
use Excel;
use Validator;

class CMSController extends Controller
{
    public function useri(){
      return view('admin.useri')
      ->with('users',User::paginate(20));
    }

    public function edituseri(Request $req){
      User::find($req->id)->update([
        'name'=>$req->name,
        'email'=>$req->email,
        'active'=>$req->active,
        'admin'=>$req->admin
      ]);
      return redirect()->back();
    }

    public function usernou(){
      return view('auth.register');
    }

    public function usernoupost(Request $req){
      $v = Validator::make($req->all(),[
        'nume' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|confirmed|min:6',
      ]);

      if($v->fails()){
        return redirect()->back()->withErrors($v)->withInput();
      }else{
        $u = new User();
        $u->name = $req->nume;
        $u->email = $req->email;
        $u->password = \Hash::make($req->password);
        $u->active = 1;
        $u->save();

        return redirect('/cms/useri');
      }
    }

    public function rapoarte(){
      return view('rapoarte');
    }

    public function rangeRaport(Request $req){
      //  dd($req->all());
        if(!empty($req->f)&&!empty($req->l)){
          $f = explode('/',$req->f);
          $l = explode('/',$req->l);
          $newf = $f[2].$f[0].$f[1];
          $newl = $l[2].$l[0].$l[1];
        }

        //dd($newf,$newl);
        switch ($req) {
          case !empty($req->l) && !empty($req->f) && empty($req->agent):
            $c = Chitanta::with('user')->whereBetween('DataPlatii',[$newf,$newl])
            ->orderBy('created_at','DESC')->paginate(20);
          break;

          case empty($req->l) && empty($req->f) && !empty($req->agent):
            $c = Chitanta::with('user')->where('IdAgentIncasator',$req->agent)
            ->orderBy('created_at','DESC')->paginate(20);
          break;

          default:
            $c = Chitanta::with('user')->where('IdAgentIncasator',$req->agent)->whereBetween('DataPlatii',[$newf,$newl])
            ->orderBy('created_at','DESC')->paginate(20);
            break;
        }
        //dd(\Carbon\Carbon::now()->toDateString());
        $date = (!empty($req->f)&&!empty($req->l)?$newf.'-'.$newl : '');
        $name = $req->agent;

        return view('rapoarte')->with('c',$c)->with('r',$date)->with('a',$name);
    }

    public function generateRaport(Request $req){
      //dd($req->raport);
      //dd($raport,$agent);

      $r = (!empty($req->raport)?explode('-',$req->raport):'');
      //$r = (!empty($raport)?explode('-',$raport):'');

      switch ($req) {
        case !empty($req->raport) && empty($req->agent):
          $c = Chitanta::with('user')->whereBetween('DataPlatii',[$r[0],$r[1]])
          ->orderBy('created_at','DESC')->paginate(20);
        break;

        case empty($req->raport) && !empty($req->agent):
          $c = Chitanta::with('user')->where('IdAgentIncasator',$req->agent)
          ->orderBy('created_at','DESC')->paginate(20);
        break;

        default:
          $c = Chitanta::with('user')->where('IdAgentIncasator',$req->agent)->whereBetween('DataPlatii',[$r[0],$r[1]])
          ->orderBy('created_at','DESC')->paginate(20);
          break;
      }
      /*$c = Chitanta::with('user')->whereBetween('DataPlatii',[$r[0],$r[1]])
      ->orderBy('created_at','DESC')->get();*/
      $raport = empty($req->raport)?\Carbon\Carbon::now()->toDateString():$req->raport;
      $pdf = Excel::create($raport, function($excel) use($c,$raport) {

          $excel->sheet($raport, function($sheet) use($c) {
            $sheet->cell(function($cells) {

                $cells->setBorder('solid', 'none', 'none', 'solid');

            });
              $sheet->setFontSize(9);

              $sheet->row(1, [
                   '#',
                   'CodAbonatRtc',
                   'SumaPlatita',
                   'DataPlatii',
                   'OraPlatii',
                   'ModPlata',
                   'ObiectPlata',
                   'Telefon',
                   'IdAgentIncasator',
              ]);

              $x=2;
              foreach($c as $k=>$v){

                $sheet->row($x++, [
                     $k,
                     $v->CodAbonatRtc,
                     $v->SumaPlatita,
                     $v->DataPlatii,
                     $v->OraPlatii,
                     $v->ModPlata,
                     $v->ObiectPlata,
                     $v->Telefon,
                     $v->IdAgentIncasator
                ]);


              }
              //$sheet->fromArray($c, null, 'A1', true, true);
          });

      })->store('pdf',storage_path('exports'));

      return response()->make(file_get_contents(storage_path('exports').'/'.$pdf->filename.'.pdf'),200,[
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; '.$pdf->filename.'.pdf',
      ]);
    }
}
