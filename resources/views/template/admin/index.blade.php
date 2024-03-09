@extends('layouts.dashboard.admin')
@section('title')
    @lang('lang.dashboard')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@lang('lang.dashboard')</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $properties }}</h3>

                            <p>@lang('lang.offers')</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-th"></i>
                        </div>
                        <a href="{{ route('admin.properties.all') }}" class="small-box-footer">@lang('lang.more info') <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $users }}</h3>

                            <p>@lang('lang.users')</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-user"></i>
                        </div>
                        <a href="{{ route('admin.users') }}" class="small-box-footer">@lang('lang.more info') <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $agents }}</h3>

                            <p>@lang('lang.agents')</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-user"></i>
                        </div>
                        <a href="{{ route('admin.agents') }}" class="small-box-footer">@lang('lang.more info') <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
