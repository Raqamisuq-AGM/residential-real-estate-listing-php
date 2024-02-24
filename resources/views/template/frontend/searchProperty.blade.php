@extends('layouts.frontend.app')
@section('title')
    @lang('lang.search results')
@endsection

@section('content')
    <div class="popular_property">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-40 text-center">
                        <h3>@lang('lang.search results')</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($properties as $property)
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="single_property">
                            <div class="property_thumb">
                                <div class="property_tag">{{ $property->type }}</div>
                                <img src="{{ asset('assets/image/property') . '/' . $property->thumb }}" alt />
                            </div>
                            <div class="property_content">
                                <div class="main_pro">
                                    <h3>
                                        <a href="{{ route('property_details', ['id' => $property->id]) }}">
                                            {{ $property->title }}
                                        </a>
                                    </h3>
                                    <div class="mark_pro">
                                        <img src="{{ asset('frontend/img/svg_icon/location.svg') }}" alt />
                                        <span>{{ $property->location }}</span>
                                    </div>
                                    <span class="amount">From ${{ $property->price }}</span>
                                </div>
                            </div>
                            <div class="footer_pro">
                                <ul>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="{{ asset('frontend/img/svg_icon/appartment.svg') }}" alt
                                                style="width: 15px" />
                                            <span>{{ $property->classification }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="{{ asset('frontend/img/svg_icon/bed.svg') }}" alt
                                                style="width: 15px" />
                                            <span>{{ $property->room }} Room</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="{{ asset('frontend/img/svg_icon/user.svg') }}" alt
                                                style="width: 12px" />
                                            <span>{{ $property->dev_name }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="margin: auto;">
                        @lang('lang.no properties found')
                    </div>
                @endforelse
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
