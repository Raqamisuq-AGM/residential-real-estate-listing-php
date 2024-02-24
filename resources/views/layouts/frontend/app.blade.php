<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <meta name="description" content />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />

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
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />

    @yield('style')
</head>

<body>
    <!-- Header -->
    @include('layouts.frontend.partials.header')
    <!-- / Header -->

    <div class="slider_area">
        <div class="single_slider single_slider2 d-flex align-items-center property_bg overlay2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="property_wrap">
                            <div class="slider_text text-center justify-content-center">
                                <h3>@lang('lang.search property')</h3>
                            </div>
                            <div class="property_form">
                                <form action="{{ route('search') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form_wrap d-flex">
                                                <div class="single-field max_width">
                                                    <label for="#">@lang('lang.place')</label>
                                                    <input type="text" class="serach_input_box" name='location'
                                                        value="{{ session('location') }}">
                                                </div>
                                                <div
                                                    class="single-field
                                                        min_width">
                                                    <label for="#">@lang('lang.room')</label>
                                                    <input type="text" class="serach_input_box" name='room'
                                                        value="{{ session('room') }}">
                                                </div>
                                                <div class="single-field min_width">
                                                    <label for="#">@lang('lang.price')</label>
                                                    <input type="text" class="serach_input_box" name='price'
                                                        value="{{ session('price') }}">
                                                </div>
                                                <div
                                                    class="single-field
                                                        min_width">
                                                    <label for="#">@lang('lang.type')</label>
                                                    <select class="wide" name='type'
                                                        value="{{ session('type') }}">
                                                        <option value="Ready">@lang('lang.ready')
                                                        </option>
                                                        <option value="under contruction">@lang('lang.under construction')</option>
                                                    </select>
                                                </div>
                                                <div class="single-field min_width">
                                                    <label for="#">@lang('lang.classification')</label>
                                                    <select class="wide" name='classification'
                                                        value="{{ session('classification') }}">
                                                        <option value="Appartment">@lang('lang.apartment')
                                                        </option>
                                                        <option value="Villa">@lang('lang.villa')</option>
                                                        <option value="Land">@lang('lang.land')</option>
                                                    </select>
                                                </div>
                                                <div class="serach_icon">
                                                    <button type="submit">
                                                        <i class="ti-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    @yield('content')
    <!-- / Content -->

    <!-- Footer -->
    @include('layouts.frontend.partials.footer')
    <!-- / Footer -->
</body>

</html>
