<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Rol extends Model
{
    protected $fillable = [
        'name', 
    ];
    
    
    public function usuarios(){
        return $this->hasMany(User::class,'rol_id');
    }
}
