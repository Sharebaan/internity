<?php
//Developer : serban@infora.ro

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index')->middleware('reset');
    Route::get('/platafacturi', 'FacturiController@index')->middleware('reset');
    Route::post('/platafacturi', 'FacturiController@scan');

    Route::get('/depozite', 'DepoziteController@index');
    Route::post('/depozite', 'DepoziteController@cod');

    Route::get('/detaliifactura','DepoziteController@detaliifactura')->middleware('factura');
    Route::get('/detaliiplata', 'DepoziteController@detaliiplata')->middleware('plata');
    Route::post('/detaliiplata', 'DepoziteController@postdetaliiplata');

    Route::get('/confirmaredepozit', 'DepoziteController@confirmare')->middleware('confirmare');
    Route::post('/confirmaredepozit', 'DepoziteController@postconfirmare');
    Route::get('/confirmare', 'FacturiController@confirmare')->middleware('confirmare');
    Route::post('/confirmare', 'FacturiController@postconfirmare');

    Route::get('/trimite','FacturiController@trimite');
    Route::get('/trimitedepozit','DepoziteController@trimite');


    Route::get('/plati','ChitanteController@index')->middleware('reset');
    Route::get('/plata/{id}','ChitanteController@generateChitanta');
    Route::get('/rangeplata','ChitanteController@rangeChitanta');
    Route::get('/searchplata','ChitanteController@searchChitanta');

    Route::group(['middleware' => 'admin'],function(){
      Route::get('/cms/useri','CMSController@useri')->middleware('reset');
      Route::get('/cms/usernou','CMSController@usernou')->middleware('reset');
      Route::post('/cms/usernou','CMSController@usernoupost');
      Route::post('/cms/useri','CMSController@edituseri');
      Route::get('/cms/rapoarte','CMSController@rapoarte');
      Route::get('/rangeraport','CMSController@rangeRaport');//
      Route::get('/cms/getRaport/{raport}/{agent}','CMSController@generateRaport');
    });

    /*Route::get('/da',function(){
      echo \Hash::make('avenir');
    });

/*    Route::get('/cnn',function(){
        $r=null;
        $path = storage_path().'/app/public/cnn/';
        $today = [];
        $sume = [];
        $now = \Carbon\Carbon::now()->toDateString();
        $c = App\Chitanta::all();

        foreach($c as $k=>$v){
          if(explode(' ',$v->created_at)[0] == $now){
            $today[$k] = $v;
            $sume[$k] = ltrim(App\Library\FormatData::price($v->SumaPlatita),0);
          }
        }

        $col = [
          'DatadeInceput'=> $now,
          'OradeInceput'=>\Carbon\Carbon::now()->toTimeString(),
          'NumardeInregistrari'=>count(array_values($today)),
          'TotalsumaIncasata'=>array_sum(array_values($sume)),
          'DatadeSfarsit'=>$now,
          'OradeSfarsit'=>'23:59:59'
        ];

        foreach($col as $k=>$v){
            $r .= $k.' '.$v."\r\n";
        }

        $filename = 'xxx'.$now.'.cnn';
        File::put($path.$filename,$r);
        //return response()->download($path.$filename);
        //dd('done');
    });
/*
  Route::get('/cnn',function(){
      //dd(storage_path());
      $path = storage_path().'/app/public/';
      $col = ['unu','doi'];
      $da = ['da','nu'];
      $a=null;
      foreach($col as $k=>$v){
          $a .= $v." ".$da[$k]."\r\n";
      }
      File::put($path.'da.cnn',$a);

      //dd(Storage::get('/app/public/da.cnn'));
      //File::put($path.'da.cnn','da');
      return response()->download($path.'da.cnn');

    });

    Route::get('/test',function(){
          //App\Library\Da::da();
    });

    Route::get('/pdf',function(){

    //  $d = [];
      $data = App\Chitanta::find(1)->toArray();
      //dd($data);
      $d=[
        "CodAbonatRtc" => $data['CodAbonatRtc'],
        "SumaPlatita" => $data['SumaPlatita'],
        "DataPlatii" => $data['DataPlatii'],
        "OraPlatii" => $data['OraPlatii'],
        "ModPlata" => $data['ModPlata'],
        "ObiectPlata" => $data['ObiectPlata'],
        "Telefon" => $data['Telefon'],
        "IdAgentIncasator" => $data['IdAgentIncasator'],

      ];*/
      //dd($d);
    /*  foreach($data as $k=>$v){
        $d[$k] = [
          'Id'=>$k+1,
          'CodAbonatRtc'=>$v->CodAbonatRtc,
          'SumaPlatita'=>$v->SumaPlatita,
          'DataPlatii'=>$v->DataPlatii,
          'OraPlatii'=>$v->OraPlatii,
          'ModPlata'=>$v->ModPlata,
          'ObiectPlata'=>$v->ObiectPlata,
          'Telefon'=>$v->Telefon,
          'IdAgentIncasator'=>$v->IdAgentIncasator
        ];
      }
    //  dd($d);
      $pdf = Excel::create('aa', function($excel) use($d) {

          $excel->sheet('aa', function($sheet) use($d) {
            $sheet->cell(function($cells) {

                $cells->setBorder('solid', 'none', 'none', 'solid');

            });
            /*$sheet->setPageMargin(array(
              0,2,0,0
            ));
              $sheet->setFontSize(28);
              //$sheet->fromArray($d);
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

      return Response::make(file_get_contents(storage_path('exports').'/'.$pdf->filename.'.pdf'),200,[
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; '.$pdf->filename.'.pdf',
      ]);

    });*/
});
