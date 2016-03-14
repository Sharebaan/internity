<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Chitanta;
use App\Library\FormatData;
use File;

class LogDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates cnn file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $r=null;
      $path = storage_path().'/app/public/cnn/';
      $today = [];
      $sume = [];
      $now = \Carbon\Carbon::now()->toDateString();
      $c = Chitanta::all();

      foreach($c as $k=>$v){
        if(explode(' ',$v->created_at)[0] == $now){
          $today[$k] = $v;
          $sume[$k] = ltrim(FormatData::price($v->SumaPlatita),0);
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
//'.implode(explode('-',$now)).'
      $filename = rand(100,999).implode(explode('-',$now)).'.cnn';
      File::put($path.$filename,$r);
    }
}
