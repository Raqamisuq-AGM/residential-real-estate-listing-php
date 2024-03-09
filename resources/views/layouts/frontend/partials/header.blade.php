@php
    $systemLogo = App\Models\SystemLogo::find(1);
@endphp
<header>
    <div class="header-area">
        <div id="sticky-header" class="main-header-area">
            <div class="container">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="{{ route('index') }}">
                                    <img src="{{ asset('frontend/img') . '/' . $systemLogo->logo }}" alt />
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7"></div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                {{-- <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('offers') }}">@lang('lang.offers')</a></li>
                                        </ul>
                                    </nav>
                                </div> --}}
                                <div class="book_btn d-none d-lg-block">
                                    {{-- <a href="{{ route('login') }}">@lang('lang.login')</a> --}}
                                    @if (Auth::check())
                                        @if (Auth::user()->type == 'admin')
                                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                        @elseif (Auth::user()->type == 'agent')
                                            <a href="{{ route('agent.dashboard') }}">Dashboard</a>
                                        @else
                                            <a href="{{ route('dashboard.dashboard') }}">Dashboard</a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}">Login</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
