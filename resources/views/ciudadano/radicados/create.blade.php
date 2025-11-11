<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Radicar documento') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('ciudadano.radicados.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
            @csrf

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Asunto</label>
                <input type="text" name="asunto" class="w-full border-gray-300 rounded-md" value="{{ old('asunto') }}" required>
                @error('asunto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Descripción</label>
                <textarea name="descripcion" class="w-full border-gray-300 rounded-md" rows="4" required>{{ old('descripcion') }}</textarea>
                @error('descripcion') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Adjuntar archivo (opcional)</label>
                <input type="file" name="archivo" accept=".pdf,.jpg,.jpeg,.png">
                @error('archivo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <x-primary-button>Guardar</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
