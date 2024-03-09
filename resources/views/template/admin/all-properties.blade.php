@extends('layouts.dashboard.admin')
@section('title')
    @lang('lang.all') @lang('lang.properties')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@lang('lang.all') @lang('lang.properties')</h1>
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
                            <h3 class="card-title">@lang('lang.properties')</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.thumb')</th>
                                        <th>@lang('lang.property_id')</th>
                                        <th>@lang('lang.title')</th>
                                        <th>@lang('lang.contact number')</th>
                                        <th>@lang('lang.price')</th>
                                        <th>@lang('lang.space')</th>
                                        <th>@lang('lang.district')</th>
                                        <th>@lang('lang.room')</th>
                                        <th>@lang('lang.developer name')</th>
                                        <th>@lang('lang.ready/construction')</th>
                                        <th>@lang('lang.type')</th>
                                        <th>@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($properties as $property)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                @if ($property->images->isNotEmpty())
                                                    <img src="{{ asset('assets/image/property/' . $property->images->first()->img) }}"
                                                        alt="Property Image" style="width: 50px;">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $property->property_id }}</td>
                                            <td>{{ $property->title }}</td>
                                            <td>{{ $property->contact_number }}</td>
                                            <td>${{ $property->price }}</td>
                                            <td>{{ $property->space }}</td>
                                            <td>{{ $property->district }}</td>
                                            <td>{{ $property->rooms }}</td>
                                            <td>{{ $property->dev_name }}</td>
                                            <td>{{ $property->ready_construction }}</td>
                                            <td>{{ $property->property_type }}</td>
                                            <td>
                                                <a href="{{ route('admin.properties.edit', ['id' => $property->id]) }}"
                                                    style="margin-right: 15px; color: #0c4b36">
                                                    <i class="fas fa-pen" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('admin.properties.delete', ['id' => $property->id]) }}"
                                                    style="color: #0c4b36">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center">@lang('lang.no properties found')</td>
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
