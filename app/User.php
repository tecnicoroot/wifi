<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\meuResetDeSenha;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','idperfil','tpstatus',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['created_at','updated_at','deleted_at'];
    public $timestamps = TRUE;

    public function status($type = null)
    {
        $types = [
            
            "A" => 'Ativado',
            "D" => 'Desativado',
            
        ];

        if (!$type)
            return $types;

        return $types[$type];
    }

    public function perfil($type = null)
    {
        $types = [
            1 => 'Administrador',
            2 => 'Usuário',
            
        ];

        if (!$type)
            return $types;

        return $types[$type];
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new meuResetDeSenha($token));
    }
}
