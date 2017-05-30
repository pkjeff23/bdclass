<?php

namespace App;

use App\Rol;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','lastname','dni','rol_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function rol (){
        return $this->belongsTo(Rol::class,'rol_id');
    }
    
    public function docentes (){
        return $this->hasMany(profesor::class,'user_id');
    }
    
    public function alumnos (){
        return $this->hasMany(estudiante::class,'user_id');
    }
}
