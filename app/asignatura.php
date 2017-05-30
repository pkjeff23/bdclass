<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\curso;

class asignatura extends Model
{
    protected $fillable = [
        'nombre', 'nombre_corto',
    ];
    
    public function asignaturas(){
        return $this->hasMany(curso::class,'asignatura_id');
    }
     
}
