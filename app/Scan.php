<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "scan";

    protected $fillable = [
        'cod_abonat', 'nr_apel', 'total_plata','data_scadenta'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
