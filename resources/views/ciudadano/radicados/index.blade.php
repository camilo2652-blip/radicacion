<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis radicados') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($radicados->isEmpty())
            <p class="text-gray-600">No tienes radicados registrados.</p>
        @else
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Número</th>
                        <th class="px-4 py-2 text-left">Asunto</th>
                        <th class="px-4 py-2 text-left">Fecha</th>
                        <th class="px-4 py-2 text-left">Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($radicados as $radicado)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $radicado->numero }}</td>
                            <td class="px-4 py-2">{{ $radicado->asunto }}</td>
                            <td class="px-4 py-2">{{ $radicado->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">
                                @if ($radicado->archivo)
                                    <a href="{{ asset('storage/' . $radicado->archivo) }}" target="_blank" class="text-blue-600 hover:underline">Ver archivo</a>
                                @else
                                    <span class="text-gray-500">Sin archivo</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
