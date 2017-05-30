<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estudiante extends Model
{
    protected $fillable = [
        'codigo', 'user_id', 'grados_id', 'id',
    ];
    
    
    public function grado (){
        return $this->belongsTo(grado::class,'grados_id');
    }
    public function usuario (){
        return $this->belongsTo(User::class,'user_id');
    }
    
       public function calificaciones(){
        return $this->hasMany(nota::class,'nota_id');
    }
}
