<x-guest-layout>

<style>
    .contenedor-register {
        display: flex;
        flex-direction: row;
        min-height: 80vh;
        width: 100%;
        max-width: 900px;
        margin: 4rem auto;
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
        border-radius: 0.5rem;
        overflow: hidden;
        background-color: white;
    }

    .register-imagen {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f3f4f6;
    }

    .register-imagen img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .register-formulario {
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 2rem;
    }

    @media (max-width: 768px) {
        .contenedor-register {
            flex-direction: column;
            max-width: 100%;
            min-height: auto;
            height: auto;
        }

        .register-imagen,
        .register-formulario {
            width: 100%;
            height: auto;
        }

        .register-imagen img {
            height: 200px;
            object-fit: cover;
        }
    }
</style>

<div class="contenedor-register">
    <!-- Imagen -->
    <div class="register-imagen">
        <img src="{{ asset('imagenes/perris.jpg') }}" alt="PATITAS A LA OBRA">
    </div>

    <!-- Formulario -->
    <div class="register-formulario">
         <h4 class="text-2xl font-bold mb-6 text-center"> 🐾 PATITAS A LA OBRA 🐾</h4>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div>
                <x-input-label for="name" :value="'Nombre completo'" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Correo -->
            <div class="mt-4">
                <x-input-label for="email" :value="'Correo electrónico'" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-input-label for="password" :value="'Contraseña'" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmar Contraseña -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="'Confirmar Contraseña'" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Tipo de Usuario -->
            <div class="mt-4">
                <label for="tipo_usuario" class="block text-sm font-medium text-gray-700">Tipo de usuario</label>
                <select name="tipo_usuario" id="tipo_usuario" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="usuario">Usuario Normal</option>
                    <option value="veterinaria">Veterinaria</option>
                    <option value="refugio">Refugio</option>
                </select>
            </div>

            <!-- Botón y enlace -->
            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    ¿Ya tienes cuenta? Inicia sesión
                </a>

                <x-primary-button>
                    Registrarse
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

</x-guest-layout>
