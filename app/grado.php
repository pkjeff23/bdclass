<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grado extends Model
{
    protected $fillable = [
        'nombre',
    ];
    public function cursos(){
        return $this->hasMany(curso::class,'grado_id');
    }
    
    public function estudiantes(){
        return $this->hasMany(estudiante::class,'grados_id');
    }
}
