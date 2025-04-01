<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
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
            <p class="mb-5">Por favor, ingresa tus credenciales...</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-floating form-floating-outline mb-6">
                    <x-text-input class="form-control" id="email"  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" aria-describedby="floatingInputHelp"/>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-floating form-floating-outline mb-6">


                    <x-text-input id="password" class="form-control"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recordarme') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif

                </div>
                <div class="flex mt-4">
                <a class=""  href="{{ route('register') }}">Regístrate</a>
                </div>
                <div class="flex items-end mt-4">
                    <x-primary-button class="btn btn-primary" style="align-items: right;">
                        {{ __('Iniciar sesión') }}
                    </x-primary-button>
                </div>
            </form>
          </div>
        </div>
</x-guest-layout>
