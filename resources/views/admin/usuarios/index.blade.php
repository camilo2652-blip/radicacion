<x-app-layout>
    <div class="p-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                📋 Usuarios del sistema
            </h1>

            <a href="{{ route('admin.usuarios.create') }}"
   class="inline-flex items-center px-4 py-2 bg-white text-gray-700 font-semibold border rounded-lg shadow hover:bg-gray-100 transition">
    ➕ Agregar usuario
</a>


        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Correo</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Rol</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Acciones</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($usuarios as $usuario)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $usuario->nombre }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $usuario->email }}</td>

                            <td class="px-6 py-4">
                                <span class="
                                    px-3 py-1 text-xs font-semibold rounded-full
                                    @if($usuario->rol === 'administrador') bg-purple-100 text-purple-700
                                    @elseif($usuario->rol === 'dependencia') bg-blue-100 text-blue-700
                                    @elseif($usuario->rol === 'ventanilla') bg-green-100 text-green-700
                                    @else bg-gray-100 text-gray-700
                                    @endif
                                ">
                                    {{ ucfirst($usuario->rol) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right flex items-center justify-end gap-3">

                                {{-- Botón Editar --}}
                                <button onclick="document.getElementById('edit-{{ $usuario->id }}').showModal()"
                                    class="text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                                    ✏️ <span class="text-sm">Editar</span>
                                </button>

                                {{-- Botón Eliminar --}}
                                <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('¿Eliminar este usuario?')"
                                            class="text-red-600 hover:text-red-800 transition flex items-center gap-1">
                                        🗑️ <span class="text-sm">Eliminar</span>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal de edición --}}
                        <dialog id="edit-{{ $usuario->id }}" class="rounded-xl shadow-xl p-6 w-96">
                            <h2 class="text-lg font-semibold mb-4">Editar usuario</h2>

                            <form method="POST" action="{{ route('admin.usuarios.update', $usuario->id) }}" class="space-y-3">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="text-sm font-semibold">Nombre</label>
                                    <input type="text" name="nombre" value="{{ $usuario->nombre }}"
                                           class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Correo</label>
                                    <input type="email" name="email" value="{{ $usuario->email }}"
                                           class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Rol</label>
                                    <select name="rol" class="w-full border rounded-lg px-3 py-2 mt-1">
                                        <option value="ciudadano" {{ $usuario->rol == 'ciudadano' ? 'selected' : '' }}>Ciudadano</option>
                                        <option value="ventanilla" {{ $usuario->rol == 'ventanilla' ? 'selected' : '' }}>Ventanilla</option>
                                        <option value="dependencia" {{ $usuario->rol == 'dependencia' ? 'selected' : '' }}>Dependencia</option>
                                        <option value="administrador" {{ $usuario->rol == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                    </select>
                                </div>

                                <div class="flex justify-end gap-2 mt-4">
                                    <button type="button"
                                            onclick="document.getElementById('edit-{{ $usuario->id }}').close()"
                                            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                                        Cancelar
                                    </button>

                                    <button type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Guardar
                                    </button>
                                </div>
                            </form>
                        </dialog>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
