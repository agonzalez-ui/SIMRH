@csrf

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Vehículo</label>
    <select name="vehiculo_id" class="mt-1 block w-full border-gray-300 rounded shadow-sm">
        <option value="">— Seleccioná un vehículo —</option>
        @foreach ($vehiculos as $v)
            <option value="{{ $v->id }}" {{ old('vehiculo_id', $orden->vehiculo_id ?? '') == $v->id ? 'selected' : '' }}>
                {{ $v->marca }} {{ $v->modelo }} — {{ $v->placa }} ({{ $v->cliente->nombre }})
            </option>
        @endforeach
    </select>
    @error('vehiculo_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Descripción del problema</label>
    <textarea name="descripcion" rows="3"
        class="mt-1 block w-full border-gray-300 rounded shadow-sm">{{ old('descripcion', $orden->descripcion ?? '') }}</textarea>
    @error('descripcion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Diagnóstico (opcional)</label>
    <textarea name="diagnostico" rows="3"
        class="mt-1 block w-full border-gray-300 rounded shadow-sm">{{ old('diagnostico', $orden->diagnostico ?? '') }}</textarea>
    @error('diagnostico') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Estado</label>
    <select name="estado" class="mt-1 block w-full border-gray-300 rounded shadow-sm">
        @foreach ($estados as $estado)
            <option value="{{ $estado }}" {{ old('estado', $orden->estado ?? 'Recibido') == $estado ? 'selected' : '' }}>
                {{ $estado }}
            </option>
        @endforeach
    </select>
    @error('estado') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>