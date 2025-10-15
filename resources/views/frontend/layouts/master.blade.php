<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta content="Codescandy" name="author"/>
    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('frontend_asset/libs/slick-carousel/slick/slick.css') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend_asset/libs/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend_asset/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet"/>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon"
          href="{{ asset('frontend_asset/images/favicon/favicon.ico') }}"/>

    <!-- Libs CSS -->
    <link href="{{ asset('frontend_asset/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}"
          rel="stylesheet"/>
    <link href="{{ asset('frontend_asset/libs/feather-webfont/dist/feather-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend_asset/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend_asset/css/custom.css?').rand(0,999) }}" rel="stylesheet"/>


    <!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('frontend_asset/css/theme.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend_asset/css/custom.css') }}"/>
    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] =
                c[a] ||
                function () {
                    (c[a].q = c[a].q || []).push(arguments);
                };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "kuc8w5o9nt");
    </script>
    @livewireStyles
    @yield('styles')
</head>

<body>

@include('frontend.layouts.includes.navbar')
@include('frontend.layouts.includes.modals')
@include('frontend.layouts.includes.shop-cart')


<script src="{{ asset('frontend_asset/js/vendors/validation.js') }}"></script>

@yield('content')

@include('frontend.layouts.includes.footer')

<!-- Javascript-->

<!-- Libs JS -->
<!-- <script src="./libs/jquery/dist/jquery.min.js"></script> -->
<script src="{{ asset('frontend_asset/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend_asset/libs/simplebar/dist/simplebar.min.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('frontend_asset/js/theme.min.js') }}"></script>

<script src="{{ asset('frontend_asset/js/vendors/jquery.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/vendors/countdown.js') }}"></script>
<script src="{{ asset('frontend_asset/libs/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/vendors/slick-slider.js') }}"></script>
<script src="{{ asset('frontend_asset/libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<script src="{{ asset('frontend_asset/js/vendors/tns-slider.js') }}"></script>
<script src="{{ asset('frontend_asset/js/vendors/zoom.js') }}"></script>

<!-- Sweet Alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('frontend.layouts.includes.scripts.cart-alert')

@yield('js')
@livewireScripts
</body>


</html>
