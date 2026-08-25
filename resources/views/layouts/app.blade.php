<!DOCTYPE html>
<html lang="es"
      dir="ltr"
      data-nav-layout="vertical"
      data-theme-mode="light"
      data-header-styles="light"
      data-menu-styles="light"
      data-toggled="close">

@include('partials.head')

<body>

    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('assets/nowa/images/media/loader.svg') }}" alt="Cargando">
    </div>

    <div class="page">
        @include('partials.header')
        @include('partials.sidebar')

        <div class="main-content app-content">
            <div class="main-container container-fluid">
                @yield('content')
            </div>
        </div>
        @include('partials.footer')
    </div>

    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow">
            <i class="ri-arrow-up-s-fill fs-20"></i>
        </span>
    </div>

    <div id="responsive-overlay"></div>
    @include('partials.scripts')
</body>
</html>
