@extends('layouts.frontend.app')
@section('title')
    @lang('lang.property details')
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
                            <a href="{{ $property->location }}" target="_blank" style="color: #fff; margin-right:15px;">
                                Location
                            </a>
                        </p>
                        <div class="quality_quantity d-flex">
                            <div class="single_quantity" style="text-align: center;">
                                <img src="{{ asset('frontend/img/svg_icon/appartment2.svg') }}" alt style="width: 15px" />
                                <span>{{ $property->property_type }}</span>
                            </div>
                            <div class="single_quantity" style="text-align: center;">
                                <img src="{{ asset('frontend/img/svg_icon/bed2.svg') }}" alt style="width: 15px" />
                                <span>{{ $property->rooms }} @lang('lang.room')</span>
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
                        <div
                            style="display: flex; flex-wrap: wrap;width: fit-content;
                        float: right;">
                            <a href="#">District: {{ $property->district }}</a>
                            <a href="#">{{ $property->ready_construction }}</a>
                            <a href="#">Space: {{ $property->space }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="property_details">
        <div class="container">
            <div class="row">
                @if ($property->images->isNotEmpty())
                    <div class="col-xl-12">
                        <div class="property_banner">
                            <div class="property_banner_active owl-carousel">
                                @foreach ($property->images as $image)
                                    <div class="single_property">
                                        <img src="{{ asset('assets/image/property') . '/' . $image->img }}" alt />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="details_info">
                        <h4>@lang('lang.description')</h4>
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
