<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::with('cliente')->latest()->paginate(10);
        return view('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('vehiculos.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $datos = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'marca'      => 'required|string|max:255',
            'modelo'     => 'required|string|max:255',
            'anio'       => 'required|integer|min:1900|max:2100',
            'placa'      => 'required|string|max:20|unique:vehiculos,placa',
            'color'      => 'nullable|string|max:50',
        ], [
            'cliente_id.required' => 'Debe seleccionar un cliente.',
            'cliente_id.exists'   => 'El cliente seleccionado no es válido.',
            'marca.required'      => 'La marca es obligatoria.',
            'modelo.required'     => 'El modelo es obligatorio.',
            'anio.required'       => 'El año es obligatorio.',
            'anio.integer'        => 'El año debe ser un número.',
            'placa.required'      => 'La placa es obligatoria.',
            'placa.unique'        => 'Ya existe un vehículo con esa placa.',
        ]);

        Vehiculo::create($datos);

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('vehiculos.edit', compact('vehiculo', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $datos = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'marca'      => 'required|string|max:255',
            'modelo'     => 'required|string|max:255',
            'anio'       => 'required|integer|min:1900|max:2100',
            'placa'      => 'required|string|max:20|unique:vehiculos,placa,' . $vehiculo->id,
            'color'      => 'nullable|string|max:50',
        ], [
            'cliente_id.required' => 'Debe seleccionar un cliente.',
            'cliente_id.exists'   => 'El cliente seleccionado no es válido.',
            'marca.required'      => 'La marca es obligatoria.',
            'modelo.required'     => 'El modelo es obligatorio.',
            'anio.required'       => 'El año es obligatorio.',
            'placa.required'      => 'La placa es obligatoria.',
            'placa.unique'        => 'Ya existe un vehículo con esa placa.',
        ]);

        $vehiculo->update($datos);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()->route('vehiculos.index')->with('success', 'Vehiculo eliminado correctamente.');
    }
}
