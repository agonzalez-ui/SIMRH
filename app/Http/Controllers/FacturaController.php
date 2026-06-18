<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Orden;
use App\Models\Repuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with('orden.vehiculo.cliente')->latest()->paginate(10);
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        // Solo órdenes que NO tengan factura todavía
        $ordenes = Orden::with('vehiculo.cliente')
            ->whereDoesntHave('factura')
            ->get();
        $repuestos = Repuesto::orderBy('nombre')->get();
        return view('facturas.create', compact('ordenes', 'repuestos'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'orden_id' => 'required|exists:ordenes,id',
            'mano_obra' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.repuesto_id' => 'required|exists:repuestos,id',
            'items.*.cantidad' => 'required|integer|min:1',
        ], [
            'orden_id.required' => 'Debe seleccionar una orden.',
            'items.required' => 'Debe agregar al menos un repuesto.',
            'items.min' => 'Debe agregar al menos un repuesto.',
        ]);

        DB::transaction(function () use ($datos) {
            // 1. Calcular el total sumando repuestos + mano de obra
            $totalRepuestos = 0;
            foreach ($datos['items'] as $item) {
                $repuesto = Repuesto::find($item['repuesto_id']);
                $totalRepuestos += $repuesto->precio * $item['cantidad'];
            }
            $total = $totalRepuestos + $datos['mano_obra'];

            // 2. Crear la factura
            $factura = Factura::create([
                'orden_id' => $datos['orden_id'],
                'mano_obra' => $datos['mano_obra'],
                'total' => $total,
            ]);

            // 3. Colgar cada repuesto en el pivote (con su precio congelado)
            foreach ($datos['items'] as $item) {
                $repuesto = Repuesto::find($item['repuesto_id']);
                $factura->repuestos()->attach($repuesto->id, [
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $repuesto->precio,
                ]);
            }
        });

        return redirect()->route('facturas.index')
            ->with('success', 'Factura registrada correctamente.');
    }

    public function show(Factura $factura)
    {
        $factura->load('repuestos', 'orden.vehiculo.cliente');
        return view('facturas.show', compact('factura'));
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();

        return redirect()->route('facturas.index')
            ->with('success', 'Factura eliminada correctamente.');
    }
}