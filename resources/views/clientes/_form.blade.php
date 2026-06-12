@csrf

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Nombre</label>
    <input type="text" name="nombre"
           value="{{ old('nombre', $cliente->nombre ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('nombre') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Cédula</label>
    <input type="text" name="cedula"
           value="{{ old('cedula', $cliente->cedula ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('cedula') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Teléfono</label>
    <input type="text" name="telefono"
           value="{{ old('telefono', $cliente->telefono ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('telefono') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Correo (opcional)</label>
    <input type="email" name="email"
           value="{{ old('email', $cliente->email ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
    @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Dirección (opcional)</label>
    <textarea name="direccion" rows="3"
              class="mt-1 block w-full border-gray-300 rounded shadow-sm">{{ old('direccion', $cliente->direccion ?? '') }}</textarea>
    @error('direccion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>