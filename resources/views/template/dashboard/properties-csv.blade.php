@extends('layouts.dashboard.dashboard')
@section('title')
    @lang('lang.upload csv')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
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
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header" style="background: #0c4b36">
                                        <h3 class="card-title">@lang('lang.upload csv')</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form method="POST" action="{{ route('dashboard.properties.csv-submit') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="csv">@lang('lang.upload csv')</label>
                                                <input type="file"
                                                    class="form-control @error('csv') is-invalid @enderror" id="csv"
                                                    name="csv" placeholder="@lang('lang.csv')" required />
                                                @error('csv')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" style="background: #0c4b36">
                                                @lang('lang.submit')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!--/.col (left) -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.row -->
            @endif
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
