<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

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
}
