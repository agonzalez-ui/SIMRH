<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $clientes = Cliente::latest()->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:clientes,cedula',
            'telefono' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'cedula.required' => 'La cedula es obligatoria',
            'cedula.unique' => 'Ya existe un cliente con esa cedula',
            'telefono.required' => 'El telefono es obligatorio',
            'email.email' => 'El correo no tiene un formato valido'
        ]);

        Cliente::create($datos);

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente.');
            
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:clientes,cedula' . $cliente->id,
            'telefono' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'cedula.required' => 'La cedula es obligatoria',
            'cedula.unique' => 'Ya existe un cliente con esa cedula',
            'telefono.required' => 'El telefono es obligatorio',
            'email.email' => 'El correo no tiene un formato valido'
        ]);

        cliente->update($datos);

        return redirect()->route('cliente.index')->with('success', 'Cliente actulizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('cliente.inde')->with('success', 'Cliente eliminado correctamente.');
    }
}
