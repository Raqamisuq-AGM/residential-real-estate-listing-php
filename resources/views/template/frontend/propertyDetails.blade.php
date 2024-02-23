@extends('layouts.frontend.app')
@section('title')
    {{ 'Property Details' }}
@endsection

@section('content')
    <div class="property_details_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-8 col-lg-6">
                    <div class="comfortable_apartment">
                        <h4>{{ $property->title }}</h4>
                        <p>
                            <img src="{{ asset('frontend/img/svg_icon/location.svg') }}" alt />
                            {{ $property->location }}
                        </p>
                        <div class="quality_quantity d-flex">
                            <div class="single_quantity" style="text-align: center;">
                                <img src="{{ asset('frontend/img/svg_icon/appartment2.svg') }}" alt style="width: 15px" />
                                <span>{{ $property->classification }}</span>
                            </div>
                            <div class="single_quantity" style="text-align: center;">
                                <img src="{{ asset('frontend/img/svg_icon/bed2.svg') }}" alt style="width: 15px" />
                                <span>{{ $property->room }} Room</span>
                            </div>
                            <div class="single_quantity" style="text-align: center;">
                                <img src="{{ asset('frontend/img/svg_icon/user2.svg') }}" alt style="width: 15px" />
                                <span>{{ $property->dev_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-4 col-lg-6">
                    <div class="prise_quantity">
                        <h4>${{ $property->price }}</h4>
                        {{-- <a href="property_details.html#">+10 367 457 735</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="property_details">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="property_banner">
                        <div class="property_banner_active owl-carousel">
                            <div class="single_property">
                                <img src="{{ asset('assets/image/property') . '/' . $property->slider1 }}" alt />
                            </div>
                            <div class="single_property">
                                <img src="{{ asset('assets/image/property') . '/' . $property->slider2 }}" alt />
                            </div>
                            <div class="single_property">
                                <img src="{{ asset('assets/image/property') . '/' . $property->slider3 }}" alt />
                            </div>
                            <div class="single_property">
                                <img src="{{ asset('assets/image/property') . '/' . $property->slider4 }}" alt />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="details_info">
                        <h4>Description</h4>
                        <p>
                            {!! $property->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .slider_area {
            display: none;
        }
    </style>
@endsection
