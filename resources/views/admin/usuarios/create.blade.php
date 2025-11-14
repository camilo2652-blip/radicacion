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

            <!-- Contraseña y Confirmar Contraseña con un solo botón -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="password" type="password" name="password" class="border rounded px-3 py-2 w-full max-w-md pr-10" required>

                <label class="block text-sm font-medium text-gray-700 mt-4">Confirmar Contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="border rounded px-3 py-2 w-full max-w-md pr-10" required>

                <button type="button" id="togglePasswords" class="absolute top-2 right-3 flex items-center text-gray-400 text-lg">🙈</button>
            </div>

            <div class="flex justify-end space-x-2 mt-4">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border rounded hover:bg-gray-100">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>

    <script>
        const togglePasswords = document.querySelector('#togglePasswords');
        const password = document.querySelector('#password');
        const passwordConfirmation = document.querySelector('#password_confirmation');

        togglePasswords.addEventListener('click', () => {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            passwordConfirmation.type = type;
            togglePasswords.textContent = type === 'password' ? '🙈' : '🙉';
        });
    </script>
</x-app-layout>
