<x-guest-layout>
<a href="index.html" class="auth-cover-brand d-flex align-items-center gap-2">
        <img class="app-brand-logo demo" src="{{asset('assets/img/brand/logo.png')}}" style="width: 150px;"/>
      </a>
<div class="authentication-wrapper authentication-cover">
    <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-12 pb-2">
          <img
            src="{{asset('assets/img/illustrations/auth-register-illustration-light.png')}}"
            class="auth-cover-illustration w-100"
            alt="auth-illustration"
            data-app-light-img="illustrations/auth-register-illustration-light.png"
            data-app-dark-img="illustrations/auth-register-illustration-dark.png" />
          <img
            src=" {{asset('assets/img/illustrations/auth-cover-register-mask-light.png')}} "
            class="authentication-image"
            alt="mask"
            data-app-light-img="illustrations/auth-cover-register-mask-light.png"
            data-app-dark-img="illustrations/auth-cover-register-mask-dark.png" />
        </div>
        <div
          class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-12 px-12 py-6">
          <div class="w-px-400 mx-auto pt-5 pt-lg-0">
            <h4 class="mb-1">Inicio de sesión</h4>
            <p class="mb-5">Por favor ingresa tus credenciales de acceso...</p>
    <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-floating form-floating-outline mb-6">
                <x-text-input class="form-control" id="name" type="text" name="name" :value="old('name')" aria-describedby="floatingInputHelp" required autofocus autocomplete="name" />
                <x-input-label for="name" :value="__('Nombre')" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="form-floating form-floating-outline mb-6">

                <x-text-input id="email"  class="form-control" type="email" name="email"  :value="old('email')" required autocomplete="username" />
                <x-input-label for="email" :value="__('Email')" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-floating form-floating-outline mb-6">


                <x-text-input id="password"  class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-label for="password" :value="__('Contraseña')" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-floating form-floating-outline mb-6">


                <x-text-input id="password_confirmation" class="form-control"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-label for="password_confirmation" :value="__('Confirma tu contraseña')" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>

                <x-primary-button class="btn btn-primary">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
</x-guest-layout>
