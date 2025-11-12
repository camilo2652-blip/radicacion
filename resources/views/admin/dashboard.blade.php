<x-app-layout>
    <div class="p-8">
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Panel del Administrador</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('admin.usuarios.create') }}" class="p-6 bg-green-100 hover:bg-green-200 rounded-xl text-center shadow">
                👤 Crear Usuarios
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="p-6 bg-blue-100 hover:bg-blue-200 rounded-xl text-center shadow">
                📋 Consultar Usuarios
            </a>
            <a href="{{ route('admin.historico') }}" class="p-6 bg-yellow-100 hover:bg-yellow-200 rounded-xl text-center shadow">
                🗂️ Histórico de Radicaciones
            </a>
        </div>
    </div>
</x-app-layout>
