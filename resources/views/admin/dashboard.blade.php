<x-app-layout>
    <div class="p-8">
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Panel del Administrador</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Crear usuarios -->
            <a href="{{ route('admin.usuarios.create') }}" 
               class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition flex flex-col items-center">
                <span class="text-4xl mb-2">👤</span>
                <span class="text-gray-700 font-semibold">Crear Usuarios</span>
            </a>

            <!-- Consultar usuarios -->
            <a href="{{ route('admin.usuarios.index') }}" 
               class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition flex flex-col items-center">
                <span class="text-4xl mb-2">📋</span>
                <span class="text-gray-700 font-semibold">Consultar Usuarios</span>
            </a>

            <!-- Histórico -->
            <a href="{{ route('admin.historico') }}" 
               class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition flex flex-col items-center">
                <span class="text-4xl mb-2">🗂️</span>
                <span class="text-gray-700 font-semibold">Consultar Histórico</span>
            </a>
        </div>
    </div>
</x-app-layout>
