<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mikrotik extends Model
{

    use SoftDeletes;
    protected $dates = ['created_at','updated_at','deleted_at'];
    public $timestamps = TRUE;
    protected $fillable = [
        'endereco','usuario','senha','descricao',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha',
    ];

    
}
