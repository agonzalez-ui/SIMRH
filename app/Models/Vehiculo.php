<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
   

      protected $table = 'vehiculos'; // ← arreglo de la pluralización

    protected $fillable = [
        'cliente_id',
        'marca',
        'modelo',
        'anio',
        'placa',
        'color',
    ];
    /* este metodo lo que hace es encontrar al cliente de este vehiculo, y lo anda buscando por el cliente_id */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
