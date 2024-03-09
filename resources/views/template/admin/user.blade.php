@extends('layouts.dashboard.admin')
@section('title')
    @lang('lang.users')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@lang('lang.all') @lang('lang.users')</h1>
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
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.users')</h3>
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
                                        <th>@lang('lang.status')</th>
                                        <th>@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('m/d/y h:i A') }}</td>
                                            <td>{{ $user->status }}</td>
                                            <td>
                                                <a href="{{ route('admin.approve-user', ['id' => $user->id]) }}"
                                                    style="margin-right: 15px; color: #0c4b36">
                                                    <i class="fas fa-check" aria-hidden="true"></i>
                                                </a>
                                                {{-- <a href="{{ route('admin.disapprove-user', ['id' => $user->id]) }}"
                                                    style="margin-right: 15px; color: #0c4b36">
                                                    <i class="fas fa-times" aria-hidden="true"></i>
                                                </a> --}}
                                                <a href="{{ route('admin.delete-user', ['id' => $user->id]) }}"
                                                    style="color: #0c4b36">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">@lang('lang.no users found')</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if ($users->lastPage() > 1)
                                <!-- Render pagination with page numbers -->
                                <div class="pagination-wrap mt-40">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination list-wrap" style="float: right;">
                                            <!-- Previous Page Link -->
                                            @if ($users->onFirstPage())
                                                <li class="page-item disabled" aria-disabled="true">
                                                    <span class="page-link">@lang('lang.previous')</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $users->previousPageUrl() }}"
                                                        rel="prev">@lang('lang.previous')</a>
                                                </li>
                                            @endif

                                            <!-- Page links -->
                                            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                                @if ($page == $user->currentPage())
                                                    <li class="page-item active" aria-current="page">
                                                        <span class="page-link">{{ $page }}</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="{{ $url }}">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            <!-- Next Page Link -->
                                            @if ($users->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $users->nextPageUrl() }}"
                                                        rel="next">@lang('lang.next')</a>
                                                </li>
                                            @else
                                                <li class="page-item disabled" aria-disabled="true">
                                                    <span class="page-link">@lang('lang.next')</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            @endif
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
