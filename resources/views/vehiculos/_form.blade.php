@csrf

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Cliente (dueño)</label>
    <select name="cliente_id" class="mt-1 block w-full border-gray-300 rounded shadow-sm">
        <option value="">— Seleccioná un cliente —</option>
        @foreach ($clientes as $c)
            <option value="{{ $c->id }}"
                {{ old('cliente_id', $vehiculo->cliente_id ?? '') == $c->id ? 'selected' : '' }}>
                {{ $c->nombre }} ({{ $c->cedula }})
            </option>
        @endforeach
    </select>
    @error('cliente_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Marca</label>
    <input type="text" name="marca" value="{{ old('marca', $vehiculo->marca ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('marca') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Modelo</label>
    <input type="text" name="modelo" value="{{ old('modelo', $vehiculo->modelo ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('modelo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Año</label>
    <input type="number" name="anio" value="{{ old('anio', $vehiculo->anio ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('anio') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Placa</label>
    <input type="text" name="placa" value="{{ old('placa', $vehiculo->placa ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('placa') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Color (opcional)</label>
    <input type="text" name="color" value="{{ old('color', $vehiculo->color ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('color') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>