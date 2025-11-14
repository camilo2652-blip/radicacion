<x-app-layout>
    <div class="p-8">
        <h1 class="text-2xl font-semibold mb-6 text-gray-700">📜 Histórico de Radicaciones</h1>

        <div class="overflow-x-auto bg-white shadow rounded-lg border">
            <table class="min-w-full text-sm text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="py-3 px-4 border-b">Nombre</th>
                        <th class="py-3 px-4 border-b">Documento</th>
                        <th class="py-3 px-4 border-b">Correo</th>
                        <th class="py-3 px-4 border-b">Teléfono</th>
                        <th class="py-3 px-4 border-b">Número de Radicado</th>
                        <th class="py-3 px-4 border-b">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($radicados as $radicado)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $radicado->ciudadano->nombre ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $radicado->ciudadano->documento ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $radicado->ciudadano->email ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $radicado->ciudadano->telefono ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $radicado->numero ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $radicado->estado ?? 'Pendiente' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">
                                No hay radicaciones registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
