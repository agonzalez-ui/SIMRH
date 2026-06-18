<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nueva factura</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('facturas.store') }}" method="POST">
                    @csrf

                    {{-- Orden a facturar --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Orden de trabajo</label>
                        <select name="orden_id" class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                            <option value="">— Seleccioná una orden —</option>
                            @foreach ($ordenes as $orden)
                                <option value="{{ $orden->id }}" {{ old('orden_id') == $orden->id ? 'selected' : '' }}>
                                    #{{ $orden->id }} — {{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}
                                    ({{ $orden->vehiculo->cliente->nombre }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Repuestos: filas dinámicas --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Repuestos</label>
                        <table class="w-full text-left" id="tabla-items">
                            <thead>
                                <tr class="border-b text-sm text-gray-600">
                                    <th class="py-2">Repuesto</th>
                                    <th class="py-2 w-24">Cantidad</th>
                                    <th class="py-2 w-32">Subtotal</th>
                                    <th class="py-2 w-12"></th>
                                </tr>
                            </thead>
                            <tbody id="items-body">
                                {{-- Las filas se agregan con JavaScript --}}
                            </tbody>
                        </table>

                        <button type="button" id="btn-agregar"
                            class="mt-2 bg-gray-200 text-gray-700 px-3 py-1 rounded hover:bg-gray-300 text-sm">
                            + Agregar repuesto
                        </button>
                    </div>

                    {{-- Mano de obra --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Mano de obra (₡)</label>
                        <input type="number" step="0.01" name="mano_obra" id="mano-obra"
                            value="{{ old('mano_obra', 0) }}" class="mt-1 block w-48 border-gray-300 rounded shadow-sm">
                    </div>

                    {{-- Total --}}
                    <div class="mb-6 text-right">
                        <span class="text-lg font-semibold">Total: ₡<span id="total-display">0.00</span></span>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Guardar factura
                        </button>
                        <a href="{{ route('facturas.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Los precios de los repuestos, para que el JS calcule --}}
    <script>
        const REPUESTOS = @json($repuestos->mapWithKeys(fn($r) => [$r->id => ['nombre' => $r->nombre, 'precio' => (float) $r->precio]]));
        let contador = 0;

        function crearFila() {
            const tbody = document.getElementById('items-body');
            const fila = document.createElement('tr');
            fila.className = 'border-b';

            // Construir las <option> de repuestos
            let opciones = '<option value="">— Repuesto —</option>';
            for (const id in REPUESTOS) {
                opciones += `<option value="${id}">${REPUESTOS[id].nombre} (₡${REPUESTOS[id].precio.toFixed(2)})</option>`;
            }

            fila.innerHTML = `
                <td class="py-2">
                    <select name="items[${contador}][repuesto_id]" class="repuesto-select w-full border-gray-300 rounded text-sm">
                        ${opciones}
                    </select>
                </td>
                <td class="py-2">
                    <input type="number" name="items[${contador}][cantidad]" value="1" min="1"
                           class="cantidad-input w-full border-gray-300 rounded text-sm">
                </td>
                <td class="py-2 subtotal">₡0.00</td>
                <td class="py-2">
                    <button type="button" class="btn-borrar text-red-600 hover:underline text-sm">✕</button>
                </td>
            `;
            tbody.appendChild(fila);
            contador++;
        }

        function calcularTotal() {
            let total = 0;
            document.querySelectorAll('#items-body tr').forEach(fila => {
                const id = fila.querySelector('.repuesto-select').value;
                const cant = parseInt(fila.querySelector('.cantidad-input').value) || 0;
                const precio = id ? REPUESTOS[id].precio : 0;
                const subtotal = precio * cant;
                fila.querySelector('.subtotal').textContent = '₡' + subtotal.toFixed(2);
                total += subtotal;
            });
            const manoObra = parseFloat(document.getElementById('mano-obra').value) || 0;
            total += manoObra;
            document.getElementById('total-display').textContent = total.toFixed(2);
        }

        // Eventos
        document.getElementById('btn-agregar').addEventListener('click', () => {
            crearFila();
            calcularTotal();
        });

        document.getElementById('items-body').addEventListener('input', calcularTotal);
        document.getElementById('items-body').addEventListener('change', calcularTotal);
        document.getElementById('mano-obra').addEventListener('input', calcularTotal);

        document.getElementById('items-body').addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-borrar')) {
                e.target.closest('tr').remove();
                calcularTotal();
            }
        });

        // Arrancar con una fila
        crearFila();
        calcularTotal();
    </script>
</x-app-layout>