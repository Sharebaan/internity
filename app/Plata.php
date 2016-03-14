<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Plata extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "plata";

    protected $fillable = [
        'scan_id', 'utilizator', 'suma','cod_nou'
    ];

    public function scan(){
      return $this->belongsTo('App\Scan');
    }
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
