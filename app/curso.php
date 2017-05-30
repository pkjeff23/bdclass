<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class curso extends Model
{
    protected $fillable = [
        'asignatura_id', 'grado_id', 'docente_id',
    ];
    
    protected $hidden= ['id'];
    
    public function materia (){
        return $this->belongsTo(asignatura::class,'asignatura_id');
    }
    public function grado (){
        return $this->belongsTo(grado::class,'grado_id');
    }
    public function profesor(){
        return $this->belongsTo(profesor::class,'docente_id');
    }
    public function notas(){
        return $this->hasMany(nota::class,'nota_id');
    }
    
}
