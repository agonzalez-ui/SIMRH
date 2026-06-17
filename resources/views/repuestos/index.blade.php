<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Inventario de repuestos</h2>
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
                    <h3 class="text-lg font-medium">Lista de repuestos</h3>
                    <a href="{{ route('repuestos.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Nuevo repuesto
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Nombre</th>
                            <th class="py-2">Código</th>
                            <th class="py-2">Cantidad</th>
                            <th class="py-2">Stock mín.</th>
                            <th class="py-2">Precio</th>
                            <th class="py-2">Estado</th>
                            <th class="py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($repuestos as $repuesto)
                            <tr class="border-b {{ $repuesto->esta_bajo ? 'bg-red-50' : '' }}">
                                <td class="py-2">{{ $repuesto->nombre }}</td>
                                <td class="py-2">{{ $repuesto->codigo }}</td>
                                <td class="py-2 font-medium {{ $repuesto->esta_bajo ? 'text-red-600' : '' }}">
                                    {{ $repuesto->cantidad }}
                                </td>
                                <td class="py-2">{{ $repuesto->stock_minimo }}</td>
                                <td class="py-2">₡{{ number_format($repuesto->precio, 2) }}</td>
                                <td class="py-2">
                                    @if ($repuesto->esta_bajo)
                                        <span class="px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-700">
                                             Stock bajo
                                        </span>
                                    @else
                                        <span class="px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-700">
                                            OK
                                        </span>
                                    @endif
                                </td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('repuestos.edit', $repuesto) }}"
                                        class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('repuestos.destroy', $repuesto) }}" method="POST" class="inline"
                                        onsubmit="return confirm('¿Seguro que querés eliminar este repuesto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-4 text-center text-gray-500">
                                    Todavía no hay repuestos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $repuestos->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>