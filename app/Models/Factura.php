<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = [
        'orden_id',
        'mano_obra',
        'total',
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class);
    }

    // El muchos-a-muchos con datos extra en el pivote
    public function repuestos()
    {
        return $this->belongsToMany(Repuesto::class)
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }
}