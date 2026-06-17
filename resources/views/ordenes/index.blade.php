<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Órdenes de trabajo</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @php
                    $colores = [
                        'Recibido' => 'bg-gray-100 text-gray-700',
                        'Diagnosticado' => 'bg-blue-100 text-blue-700',
                        'En reparación' => 'bg-yellow-100 text-yellow-800',
                        'Esperando repuesto' => 'bg-orange-100 text-orange-800',
                        'Listo' => 'bg-green-100 text-green-700',
                        'Entregado' => 'bg-purple-100 text-purple-700',
                    ];
                @endphp

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Lista de órdenes</h3>
                    <a href="{{ route('ordenes.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Nueva orden
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Vehículo</th>
                            <th class="py-2">Dueño</th>
                            <th class="py-2">Placa</th>
                            <th class="py-2">Estado</th>
                            <th class="py-2">Ingreso</th>
                            <th class="py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ordenes as $orden)
                            <tr class="border-b">
                                <td class="py-2">{{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}</td>
                                <td class="py-2">{{ $orden->vehiculo->cliente->nombre }}</td>
                                <td class="py-2">{{ $orden->vehiculo->placa }}</td>
                                <td class="py-2">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-medium {{ $colores[$orden->estado] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $orden->estado }}
                                    </span>
                                </td>
                                <td class="py-2">{{ $orden->created_at->format('d/m/Y') }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('ordenes.edit', $orden) }}"
                                        class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('ordenes.destroy', $orden) }}" method="POST" class="inline"
                                        onsubmit="return confirm('¿Seguro que querés eliminar esta orden?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">
                                    Todavía no hay órdenes registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $ordenes->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>