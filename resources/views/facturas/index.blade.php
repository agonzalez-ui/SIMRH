<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Facturas</h2>
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
                    <h3 class="text-lg font-medium">Lista de facturas</h3>
                    <a href="{{ route('facturas.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Nueva factura
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Factura</th>
                            <th class="py-2">Cliente</th>
                            <th class="py-2">Vehículo</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Fecha</th>
                            <th class="py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($facturas as $factura)
                            <tr class="border-b">
                                <td class="py-2">#{{ $factura->id }}</td>
                                <td class="py-2">{{ $factura->orden->vehiculo->cliente->nombre }}</td>
                                <td class="py-2">{{ $factura->orden->vehiculo->marca }}
                                    {{ $factura->orden->vehiculo->modelo }}</td>
                                <td class="py-2 font-medium">₡{{ number_format($factura->total, 2) }}</td>
                                <td class="py-2">{{ $factura->created_at->format('d/m/Y') }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('facturas.show', $factura) }}"
                                        class="text-blue-600 hover:underline">Ver</a>
                                    <form action="{{ route('facturas.destroy', $factura) }}" method="POST" class="inline"
                                        onsubmit="return confirm('¿Seguro que querés eliminar esta factura?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">
                                    Todavía no hay facturas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $facturas->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>