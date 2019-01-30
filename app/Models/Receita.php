<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    protected $fillable = [
        'id',
        'titulo',
        'ingredientes',
        'preparo',
        'usuario'
    ];
    public function Ingredientess(){
        return $this->hasMany('App\Models\Ingrediente', 'receita', 'id');
    }
    public function Usuarios(){
        return $this->hasOne('App\Models\Usuario');
    }
}
