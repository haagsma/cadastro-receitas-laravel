<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    protected $fillable = [
      'ingrediente',
        'receita'
    ];
}
