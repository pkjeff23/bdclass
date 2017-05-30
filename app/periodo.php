<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class periodo extends Model
{
    protected $fillable = [
        'periodo',
    ];
    
    
    public function notas(){
        return $this->hasMany(nota::class,'periodo_id');
    }
}
