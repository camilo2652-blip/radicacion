<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-semibold mb-6 text-gray-700">👤 Crear nuevo usuario</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.usuarios.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow">
            @csrf

            {{-- Rol primero --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Rol</label>
                <select name="rol" class="border rounded px-3 py-2 w-full max-w-md" required>
                    <option value="ciudadano">Ciudadano</option>
                    <option value="ventanilla">Ventanilla</option>
                    <option value="dependencia">Dependencia</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" class="border rounded px-3 py-2 w-full max-w-md" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="email" class="border rounded px-3 py-2 w-full max-w-md" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" class="border rounded px-3 py-2 w-full max-w-md" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="border rounded px-3 py-2 w-full max-w-md" required>
            </div>

            <div class="flex justify-end space-x-2 mt-4">
                <a href="{{ route('admin.usuarios.index') }}" class="px-4 py-2 border rounded hover:bg-gray-100">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>
