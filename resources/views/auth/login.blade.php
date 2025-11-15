<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password con mono dentro -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Contraseña')" />
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="block mt-1 w-full border-gray-300 rounded-md shadow-sm pr-10" />
            <button type="button" id="togglePassword"
                    class="absolute inset-y-0 end-0 pr-3 flex items-center text-xl text-gray-400">
                🙈
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Recordar') }}</span>
            </label>
        </div>

        <!-- Registro solo para ciudadanos -->
        @if (Route::has('register'))
            <div class="mt-4 text-center">
                <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    ¿No tienes cuenta? Regístrate como ciudadano
                </a>
            </div>
        @endif

        <!-- Botón de Iniciar Sesión -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Olvidaste tu contraseña?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Script del mono -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {
            const isHidden = password.type === 'password';
            password.type = isHidden ? 'text' : 'password';
            togglePassword.textContent = isHidden ? '🙉' : '🙈';
        });
    </script>
</x-guest-layout>
