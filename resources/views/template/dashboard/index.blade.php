@extends('layouts.dashboard.dashboard')
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
            <!-- Check user status -->
            @if ($user->status == 'pending')
                <div class="alert alert-warning" role="alert">
                    Your account is pending approval.
                </div>
            @elseif($user->status == 'disapproved')
                <div class="alert alert-danger" role="alert">
                    Your account has been disapproved.
                </div>
            @elseif($user->status == 'approved')
                <section class="content">
                    <div class="container-fluid">
                        <!-- Check user status -->
                        @if ($user->status == 'pending')
                            <div class="alert alert-warning" role="alert">
                                Your account is pending approval.
                            </div>
                        @elseif($user->status == 'disapproved')
                            <div class="alert alert-danger" role="alert">
                                Your account has been disapproved.
                            </div>
                        @elseif($user->status == 'approved')
                            <section class="content">
                                <div class="container-fluid">
                                    <!-- Small boxes (Stat box) -->
                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <!-- small box -->
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    <h3>{{ $allProperties }}</h3>

                                                    <p>@lang('lang.all') @lang('lang.properties')</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="nav-icon fas fa-th"></i>
                                                </div>
                                                <a href="{{ route('dashboard.properties.all') }}"
                                                    class="small-box-footer">@lang('lang.more info') <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.container-fluid -->
                            </section>
                        @endif
                    </div>
                    <!-- /.container-fluid -->
                </section>
            @endif
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
