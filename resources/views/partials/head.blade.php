<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title', 'Radar de Integración')</title>

    <meta name="description" content="Radar de Integración - OTASS">
    <meta name="author" content="OTASS">

    <!-- Favicon -->
    <link rel="icon"
          href="{{ asset('assets/nowa/images/brand-logos/favicon.ico') }}"
          type="image/x-icon">

    <!-- Choices JS -->
    <script src="{{ asset('assets/nowa/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme JS -->
    <script src="{{ asset('assets/nowa/js/main.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link id="style"
          href="{{ asset('assets/nowa/libs/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet">

    <!-- Nowa Styles -->
    <link href="{{ asset('assets/nowa/css/styles.min.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('assets/nowa/css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves -->
    <link href="{{ asset('assets/nowa/libs/node-waves/waves.min.css') }}" rel="stylesheet">

    <!-- Simplebar -->
    <link href="{{ asset('assets/nowa/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

    <!-- Flatpickr -->
    <link rel="stylesheet"
          href="{{ asset('assets/nowa/libs/flatpickr/flatpickr.min.css') }}">

    <!-- Pickr -->
    <link rel="stylesheet"
          href="{{ asset('assets/nowa/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices CSS -->
    <link rel="stylesheet"
          href="{{ asset('assets/nowa/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- JS Vector Map -->
    <link rel="stylesheet"
          href="{{ asset('assets/nowa/libs/jsvectormap/css/jsvectormap.min.css') }}">

    <!-- Swiper -->
    <link rel="stylesheet"
          href="{{ asset('assets/nowa/libs/swiper/swiper-bundle.min.css') }}">

    @stack('styles')

</head>
