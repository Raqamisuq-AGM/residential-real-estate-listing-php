@php
    $system = App\Models\SystemLogo::get();
@endphp

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <meta name="description" content />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img') . '/' . $system[0]->fav }}" />

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/gijgo.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.css') }}" />
    <link rel="stylesheet"
        href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />

    <style>
        .header-area {
            background: {{ $system[0]->color }} !important
        }

        .popular_property .single_property .property_content .amount {
            background: {{ $system[0]->color }} !important
        }

        .property_details_banner {
            background: {{ $system[0]->color }} !important
        }
    </style>

    @yield('style')
</head>

<body>
    <!-- Header -->
    @include('layouts.frontend.partials.header')
    <!-- / Header -->



    <!-- Content -->
    @yield('content')
    <!-- / Content -->

    <!-- Footer -->
    @include('layouts.frontend.partials.footer')
    <!-- / Footer -->

    @yield('script')
</body>

</html>
