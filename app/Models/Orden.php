<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes';

    const ESTADOS = [
        'Recibido',
        'Diagnosticado',
        'En reparacion',
        'Esperando repuesto',
        'Listo',
        'Entregado',
    ];

    protected $fillable = [
        'vehiculo_id',
        'descripcion',
        'diagnostico',
        'estado',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
