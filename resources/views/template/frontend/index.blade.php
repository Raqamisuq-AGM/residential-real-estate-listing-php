@extends('layouts.frontend.app')
@section('title')
    @lang('lang.property listing')
@endsection

@section('content')
    <div class="popular_property">
        <div style="width:100%">
            <img style="width:100%" src="{{ asset('assets/image/property/Website-1.jpg') }}" alt="">
        </div>
        <div class="container" style="margin-top: 80px">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-40 text-center">
                        <h3>@lang('lang.contact us')</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <span>Whatsapp: 123456789</span>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-xl-12">
                    <div class="more_property_btn text-center">
                        <a href="Property.html" class="boxed-btn3-line">More Properties</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('style')
    <style>
        .slider_area {
            display: none !important;
        }
    </style>
@endsection
