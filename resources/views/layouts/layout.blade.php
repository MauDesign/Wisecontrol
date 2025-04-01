<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $metaTitle  ?? 'Aquadrada' }}</title>
        <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-semi-dark.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}"/>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->

        <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
        <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
        <script src="{{asset('assets/vendor/js/template-customizer.js')}}"></script>
        <script src="{{asset('assets/js/main.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>


    </head>
<body >
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <div class="layout-page">

                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                @include('layouts.nav')
                </nav>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @session('status')
                            <div>{{$value}}</div>
                        @endsession
                        {{$slot}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
