<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nota extends Model
{
    protected $fillable = [
        'curso_id', 'estudiante_id', 'periodo_id','valoracion',
    ];
    
    public function curso (){
        return $this->belongsTo(curso::class,'curso_id');
    }
    public function  alumno_nota(){
        return $this->belongsTo(estudiante::class,'estudiante_id');
    }
    public function  periodo_alumno(){
        return $this->belongsTo(periodo::class,'periodo_id');
    }
    
}
