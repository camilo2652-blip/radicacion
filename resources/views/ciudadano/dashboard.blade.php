<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Panel del Ciudadano') }}
        </h2>
    </x-slot>

    <div class="mt-10 flex flex-col items-center space-y-6">
        <a href="{{ route('ciudadano.radicados.create') }}" 
           class="text-blue-600 hover:underline text-lg">
           📄 Radicar documento
        </a>
        <a href="{{ route('ciudadano.radicados.index') }}" 
           class="text-blue-600 hover:underline text-lg">
           📁 Consultar radicados
        </a>
        <a href="{{ route('ciudadano.notificaciones.index') }}" 
           class="text-blue-600 hover:underline text-lg">
           🔔 Notificaciones
        </a>
    </div>

    @if (session('success'))
        <div id="toast-success" 
             class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in">
            ✅ {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-success');
                if (toast) toast.remove();
            }, 5000);
        </script>

        <style>
            @keyframes fade-in {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fade-in 0.4s ease-in-out;
            }
        </style>
    @endif
</x-app-layout>
