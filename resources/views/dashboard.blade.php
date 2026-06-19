<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard — Mecánica Rodríguez e Hijos</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- TARJETAS DE RESUMEN --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Clientes</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalClientes }}</p>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Vehículos</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalVehiculos }}</p>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Órdenes activas</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $ordenesActivas }}</p>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Repuestos con stock bajo</p>
                    <p class="text-3xl font-bold {{ $repuestosBajos > 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ $repuestosBajos }}
                    </p>
                </div>

            </div>

            {{-- GRÁFICO --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Órdenes por estado</h3>
                <div style="max-height: 350px;">
                    <canvas id="graficoOrdenes"></canvas>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const datosOrdenes = @json($ordenesPorEstado);

                const ctx = document.getElementById('graficoOrdenes');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(datosOrdenes),
                        datasets: [{
                            label: 'Cantidad de órdenes',
                            data: Object.values(datosOrdenes),
                            backgroundColor: [
                                '#9ca3af', '#3b82f6', '#eab308',
                                '#f97316', '#22c55e', '#a855f7',
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
                        plugins: { legend: { display: false } }
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>