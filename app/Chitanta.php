<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Chitanta extends Model
{
   use SearchableTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "chitanta";

    protected $fillable = [
        'user_id',
        'CodAbonatRtc',
        'SumaPlatita',
        'DataPlatii',
        'OraPlatii',
        'ModPlata',
        'ObiectPlata',
        'Telefon',
        'IdAgentIncasator'
    ];

    protected $searchable = [
      'columns'=>[
        'CodAbonatRtc'=>20,
        'DataPlatii'=>20,
        'Telefon'=>30,
        'IdAgentIncasator'=>50
      ]
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
