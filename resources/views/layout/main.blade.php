<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('./assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('./assets/css/styles.min.css') }}" />
    @stack('css')
    {{-- Tensorflow Js --}}
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layout.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layout.header')
            <!--  Header End -->
            {{-- Containter Start --}}
            @yield('content')
            {{-- Container End --}}
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="{{ asset('./assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('./assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('./assets/js/app.min.js') }}"></script>
    <script src="{{ asset('./assets/libs/simplebar/dist/simplebar.js') }}"></script>
    @stack('js')
</body>

</html>