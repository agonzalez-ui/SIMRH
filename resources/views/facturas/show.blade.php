<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Factura #{{ $factura->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">
                    <p><span class="font-medium">Cliente:</span> {{ $factura->orden->vehiculo->cliente->nombre }}</p>
                    <p><span class="font-medium">Vehículo:</span> {{ $factura->orden->vehiculo->marca }}
                        {{ $factura->orden->vehiculo->modelo }} — {{ $factura->orden->vehiculo->placa }}</p>
                    <p><span class="font-medium">Fecha:</span> {{ $factura->created_at->format('d/m/Y') }}</p>
                </div>

                <table class="w-full text-left border-collapse mb-4">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Repuesto</th>
                            <th class="py-2">Cantidad</th>
                            <th class="py-2">Precio unit.</th>
                            <th class="py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($factura->repuestos as $repuesto)
                            <tr class="border-b">
                                <td class="py-2">{{ $repuesto->nombre }}</td>
                                <td class="py-2">{{ $repuesto->pivot->cantidad }}</td>
                                <td class="py-2">₡{{ number_format($repuesto->pivot->precio_unitario, 2) }}</td>
                                <td class="py-2">
                                    ₡{{ number_format($repuesto->pivot->cantidad * $repuesto->pivot->precio_unitario, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right space-y-1">
                    <p><span class="font-medium">Mano de obra:</span> ₡{{ number_format($factura->mano_obra, 2) }}</p>
                    <p class="text-lg font-bold">Total: ₡{{ number_format($factura->total, 2) }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('facturas.index') }}" class="text-gray-600 hover:underline">← Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>