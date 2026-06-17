<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::with('vehiculo.cliente')->latest()->paginate(10);
        return view('ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::with('cliente')->orderBy('marca')->get();
        $estados = Orden::ESTADOS;
        return view('ordenes.create', compact('vehiculos', 'estados'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'descripcion' => 'required|string',
            'diagnostico' => 'nullable|string',
            'estado' => ['required', Rule::in(Orden::ESTADOS)],
        ], [
            'vehiculo_id.required' => 'Debe seleccionar un vehículo.',
            'vehiculo_id.exists' => 'El vehículo seleccionado no es válido.',
            'descripcion.required' => 'La descripción del problema es obligatoria.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        Orden::create($datos);

        return redirect()->route('ordenes.index')
            ->with('success', 'Orden registrada correctamente.');
    }

    public function edit(Orden $orden)
    {
        $vehiculos = Vehiculo::with('cliente')->orderBy('marca')->get();
        $estados = Orden::ESTADOS;
        return view('ordenes.edit', compact('orden', 'vehiculos', 'estados'));
    }

    public function update(Request $request, Orden $orden)
    {
        $datos = $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'descripcion' => 'required|string',
            'diagnostico' => 'nullable|string',
            'estado' => ['required', Rule::in(Orden::ESTADOS)],
        ], [
            'vehiculo_id.required' => 'Debe seleccionar un vehículo.',
            'vehiculo_id.exists' => 'El vehículo seleccionado no es válido.',
            'descripcion.required' => 'La descripción del problema es obligatoria.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        $orden->update($datos);

        return redirect()->route('ordenes.index')
            ->with('success', 'Orden actualizada correctamente.');
    }

    public function destroy(Orden $orden)
    {
        $orden->delete();

        return redirect()->route('ordenes.index')
            ->with('success', 'Orden eliminada correctamente.');
    }
}