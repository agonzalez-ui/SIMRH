@csrf

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $repuesto->nombre ?? '') }}"
        class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('nombre') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Código</label>
    <input type="text" name="codigo" value="{{ old('codigo', $repuesto->codigo ?? '') }}"
        class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('codigo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Cantidad en stock</label>
    <input type="number" name="cantidad" value="{{ old('cantidad', $repuesto->cantidad ?? 0) }}"
        class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('cantidad') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Stock mínimo (alerta)</label>
    <input type="number" name="stock_minimo" value="{{ old('stock_minimo', $repuesto->stock_minimo ?? 5) }}"
        class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('stock_minimo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Precio (₡)</label>
    <input type="number" step="0.01" name="precio" value="{{ old('precio', $repuesto->precio ?? '') }}"
        class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('precio') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>