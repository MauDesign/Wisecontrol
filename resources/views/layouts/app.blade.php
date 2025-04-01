<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $metaTitle ?? 'Wise Control' }}</title>
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon.png') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-semi-dark.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/js/dropdown-hover.js') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }} " />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.css') }} " />
<link rel="stylesheet" href="{{ asset('assets/css/responsive.dataTables.css') }} " />

<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />


<link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" /> -->
<!-- Vendor -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.css') }}" />

<!-- Styles -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr\flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar ">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme">
                @include('layouts.sidebar')
            </aside>
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-primary" id="layout-navbar">
                    <div class="container-fluid">
                        @include('layouts.navigation')
                    </div>
                </nav>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @session('status')
                            <div>{{ $value }}</div>
                        @endsession
                        @isset($header)
                            <header class="bg-white dark:bg-gray-800 shadow">
                                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                    {{ $header }}
                                </div>
                            </header>
                        @endisset
                        {{ $slot }}
                    </div>
                    <footer class="content-footer footer bg-footer-theme">
                        <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
                        <script src="{{ asset('assets/js/main.js') }}"></script>
                        <script src="{{ asset('assets/vendor/libs/flatpickr\flatpickr.js') }}"></script>
                        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
                        <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
                        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
                        <script src="{{ asset('assets/js/responsive.bootstrap5.mjs') }}"></script>
                        <script src="{{ asset('assets/js/responsive.dataTables.mjs') }}"></script>
                        <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</body>


</html>
<script>
    $(document).ready(function() {
        $('.myTable').dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            responsive: true,

        });
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new Tooltip(tooltipTriggerEl);
        });

    });
</script>
