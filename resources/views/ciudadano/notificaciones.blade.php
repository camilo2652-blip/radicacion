<x-app>
    <div class="max-w-3xl mx-auto mt-8 bg-white rounded-xl shadow p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">🔔 Mis Notificaciones</h2>

        @if ($notificaciones->isEmpty())
            <p class="text-gray-500 text-center">No tienes notificaciones por ahora.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach ($notificaciones as $noti)
                    <li class="py-3">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-gray-800">
                                    {{ $noti->titulo }}
                                </h3>
                                <p class="text-gray-600 text-sm">{{ $noti->mensaje }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $noti->created_at->diffForHumans() }}
                                </p>
                            </div>

                            @if(!$noti->leida)
                                <a href="{{ route('notificaciones.leida', $noti->id) }}" class="text-blue-600 hover:underline text-sm">
                                    Marcar como leída
                                </a>
                            @else
                                <span class="text-green-600 text-sm">✔ Leída</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app>
