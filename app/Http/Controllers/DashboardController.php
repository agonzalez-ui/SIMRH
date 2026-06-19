<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\Orden;
use App\Models\Repuesto;
use App\Models\Factura;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Tarjetas de resumen ---
        $totalClientes  = Cliente::count();
        $totalVehiculos = Vehiculo::count();

        // Órdenes activas = las que NO están "Entregado"
        $ordenesActivas = Orden::where('estado', '!=', 'Entregado')->count();

        // Repuestos bajos: traemos todos y filtramos con el accessor
        $repuestosBajos = Repuesto::all()->filter(fn($r) => $r->esta_bajo)->count();

        // --- Datos para el gráfico: órdenes por estado ---
        $ordenesPorEstado = [];
        foreach (Orden::ESTADOS as $estado) {
            $ordenesPorEstado[$estado] = Orden::where('estado', $estado)->count();
        }

        return view('dashboard', compact(
            'totalClientes',
            'totalVehiculos',
            'ordenesActivas',
            'repuestosBajos',
            'ordenesPorEstado'
        ));
    }
}

