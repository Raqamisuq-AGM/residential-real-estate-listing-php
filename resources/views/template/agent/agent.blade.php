@extends('layouts.dashboard.agent')
@section('title')
    @lang('lang.agents')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@lang('lang.all') @lang('lang.agents')</h1>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content:space-between;">
                            <h3 class="card-title">@lang('lang.agents')</h3>
                            <a href="{{ route('agent.add-agent') }}" class="btn btn-primary">Add agent</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.name')</th>
                                        <th>@lang('lang.email')</th>
                                        <th>@lang('lang.date')</th>
                                        <th>@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($agents as $agent)
                                        <tr>
                                            <td>
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td>
                                                {{ $agent->name }}
                                            </td>
                                            <td>{{ $agent->email }}</td>
                                            <td>{{ $agent->created_at->format('m/d/y h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('agent.edit-agent', ['id' => $agent->id]) }}"
                                                    style="margin-right: 15px; color: #0c4b36">
                                                    <i class="fas fa-pen" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('agent.delete-agent', ['id' => $agent->id]) }}"
                                                    style="color: #0c4b36">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">@lang('lang.no agents found')</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
