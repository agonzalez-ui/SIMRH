<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Vehículos</h2>
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
                    <h3 class="text-lg font-medium">Lista de vehículos</h3>
                    <a href="{{ route('vehiculos.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Nuevo vehículo
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Dueño</th>
                            <th class="py-2">Marca</th>
                            <th class="py-2">Modelo</th>
                            <th class="py-2">Año</th>
                            <th class="py-2">Placa</th>
                            <th class="py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehiculos as $vehiculo)
                            <tr class="border-b">
                                <td class="py-2">{{ $vehiculo->cliente->nombre }}</td>
                                <td class="py-2">{{ $vehiculo->marca }}</td>
                                <td class="py-2">{{ $vehiculo->modelo }}</td>
                                <td class="py-2">{{ $vehiculo->anio }}</td>
                                <td class="py-2">{{ $vehiculo->placa }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('vehiculos.edit', $vehiculo) }}"
                                       class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('vehiculos.destroy', $vehiculo) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('¿Seguro que querés eliminar este vehículo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">
                                    Todavía no hay vehículos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $vehiculos->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>