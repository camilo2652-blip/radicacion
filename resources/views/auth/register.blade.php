<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="nombre" :value="__('Nombre')" />
            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <!-- Documento -->
        <div class="mt-4">
            <x-input-label for="documento" :value="__('Documento')" />
            <x-text-input id="documento" class="block mt-1 w-full" type="text" name="documento" :value="old('documento')" required />
            <x-input-error :messages="$errors->get('documento')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Dirección -->
        <div class="mt-4">
            <x-input-label for="direccion" :value="__('Dirección')" />
            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Contraseña y Confirmación con un solo botón (mono) -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Contraseña')" />
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="block mt-1 w-full border-gray-300 rounded-md shadow-sm pr-10" placeholder="Contraseña" />

            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="block mt-1 w-full border-gray-300 rounded-md shadow-sm pr-10 mt-2" placeholder="Confirmar Contraseña" />

            <!-- Botón del mono -->
            <button type="button" id="togglePasswords" class="absolute top-2 right-3 flex items-center text-gray-400">🙈</button>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón de registro -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Ya estás registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Script para mostrar/ocultar contraseñas -->
    <script>
        const togglePasswords = document.querySelector('#togglePasswords');
        const password = document.querySelector('#password');
        const passwordConfirmation = document.querySelector('#password_confirmation');

        togglePasswords.addEventListener('click', () => {
            const isHidden = password.type === 'password';
            password.type = isHidden ? 'text' : 'password';
            passwordConfirmation.type = isHidden ? 'text' : 'password';
            togglePasswords.textContent = isHidden ? '🙉' : '🙈';
        });
    </script>
</x-guest-layout>
