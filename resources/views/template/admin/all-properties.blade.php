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
                        <div class="card-header" style="display: flex; justify-content:space-between;">
                            <h3 class="card-title">@lang('lang.properties')</h3>
                            <button class="btn btn-primary" id="toggleInput" onclick="">Add property</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <form method="POST" action="{{ route('admin.properties.add.submit') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>@lang('lang.thumb')</th>
                                            <th>@lang('lang.offer id')</th>
                                            <th>@lang('lang.title')</th>
                                            <th>@lang('lang.contact number')</th>
                                            <th>@lang('lang.price')</th>
                                            <th>@lang('lang.space')</th>
                                            <th>@lang('lang.district')</th>
                                            <th>@lang('lang.room')</th>
                                            <th>@lang('lang.developer name')</th>
                                            <th>@lang('lang.ready/construction')</th>
                                            <th>@lang('lang.type')</th>
                                            <th>@lang('lang.roof')</th>
                                            <th>@lang('lang.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="show-input" style="display: none;">
                                            <td></td>
                                            <td>
                                                <input type="file" name="thumb[]" style="width: 100%"
                                                    multiple="multiple">
                                            </td>
                                            <td><input type="text" disabled style="width: 100%"></td>
                                            <td><input type="text" type="text" class="form-control" id="title"
                                                    name="title" placeholder="@lang('lang.title')" style="width: 100%">
                                            </td>
                                            <td><input type="text" class="form-control" id="contact_number"
                                                    name="contact_number" placeholder="002658745" style="width: 100%"></td>
                                            <td><input type="text" class="form-control" id="price" name="price"
                                                    placeholder="50" style="width: 100%"></td>
                                            <td><input type="text" class="form-control" id="space" name="space"
                                                    placeholder="135" style="width: 100%"></td>
                                            <td><input type="text" class="form-control" id="district" name="district"
                                                    placeholder="@lang('lang.district')" style="width: 100%"></td>
                                            <td><input type="text" class="form-control" id="room" name="rooms"
                                                    placeholder="5" style="width: 100%"></td>
                                            <td><input type="text" class="form-control" id="dev_name" name="dev_name"
                                                    placeholder="jon doe" style="width: 100%"></td>
                                            <td>
                                                <select class="form-control" style="width: 100%;" name="ready_construction">
                                                    <option value="Ready">@lang('lang.ready')</option>
                                                    <option value="Under Contruction">@lang('lang.under construction')</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" style="width: 100%;" name="property_type">
                                                    <option value="Appartment">@lang('lang.apartment')</option>
                                                    <option value="Villa">@lang('lang.villa')</option>
                                                    <option value="Land">@lang('lang.land')</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" style="width: 100%;" name="roof">
                                                    <option value="yes">@lang('lang.yes')</option>
                                                    <option value="no">@lang('lang.no')</option>

                                                </select>
                                            </td>
                                            <td>
                                                <button
                                                    style="margin-right: 15px; color: #0c4b36;border: none;
                                                background: transparent;"
                                                    type="submit">
                                                    <i class="fas fa-check" aria-hidden="true"></i>
                                                </button>
                                                <a id="hideInput" href="#" style="color: #0c4b36">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
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
                                                <td>{{ $property->roof }}</td>
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
                            </form>
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

@section('style')
    <style>
        thead tr th {
            text-transform: capitalize;
        }
    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#toggleInput').click(function() {
                $('#show-input').toggle();
            });
        });

        $(document).ready(function() {
            $('#hideInput').click(function() {
                $('#show-input').toggle();
            });
        });
    </script>
@endsection
