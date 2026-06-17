<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Repuesto extends Model
{
     protected $fillable = [
        'nombre',
        'codigo',
        'cantidad',
        'stock_minimo',
        'precio',
    ];


    protected function estaBajo(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->cantidad <= $this->stock_minimo,
        );
    }
}
