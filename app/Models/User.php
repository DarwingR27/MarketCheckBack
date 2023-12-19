<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Rol;
use App\Models\Compra;
use App\Models\Establecimiento;

use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'documento',
        'email',
        'password',
        'establecimiento_id',
        'rol_id'
    ];

    public function establecimiento(){
        return $this->belongsTo(Establecimiento::class,'establecimiento_id'); 
    }

    public function rol(){
        return $this->belongsTo(Rol::class,'rol_id'); 
    }

    public function compra(){
        return $this->hasMany(Compra::class,'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
