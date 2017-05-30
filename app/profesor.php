<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class profesor extends Model
{
   protected $fillable = [
        'titulo', 'user_id',
    ];
    
    public function usuario (){
        return $this->belongsTo(User::class,'user_id');
    }
    public function cursos(){
        return $this->hasMany(curso::class,'docente_id');
    }
}
