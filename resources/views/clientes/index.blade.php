<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clientes</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Lista de clientes</h3>
                    <a href="{{ route('clientes.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Nuevo cliente
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Nombre</th>
                            <th class="py-2">Cédula</th>
                            <th class="py-2">Teléfono</th>
                            <th class="py-2">Correo</th>
                            <th class="py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clientes as $cliente)
                            <tr class="border-b">
                                <td class="py-2">{{ $cliente->nombre }}</td>
                                <td class="py-2">{{ $cliente->cedula }}</td>
                                <td class="py-2">{{ $cliente->telefono }}</td>
                                <td class="py-2">{{ $cliente->email ?? '—' }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('clientes.edit', $cliente) }}"
                                       class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('clientes.destroy', $cliente) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('¿Seguro que querés eliminar este cliente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">
                                    Todavía no hay clientes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $clientes->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>