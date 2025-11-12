<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4">Crear nuevo usuario</h2>

        <form method="POST" action="{{ route('admin.usuarios.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium text-sm">Nombre</label>
                <input name="nombre" class="border rounded w-full p-2" required>
            </div>

            <div>
                <label class="block font-medium text-sm">Correo</label>
                <input type="email" name="email" class="border rounded w-full p-2" required>
            </div>

            <div>
                <label class="block font-medium text-sm">Contraseña</label>
                <input type="password" name="password" class="border rounded w-full p-2" required>
            </div>

            <div>
                <label class="block font-medium text-sm">Rol</label>
                <select name="rol" class="border rounded w-full p-2">
                    <option value="administrador">Administrador</option>
                    <option value="ventanilla">Ventanilla</option>
                    <option value="dependencia">Dependencia</option>
                    <option value="ciudadano">Ciudadano</option>
                </select>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Crear usuario
            </button>
        </form>
    </div>
</x-app-layout>
