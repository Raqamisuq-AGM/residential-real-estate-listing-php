@php
    $system = App\Models\SystemLogo::get();
@endphp
@extends('layouts.frontend.app')
@section('title')
    @lang('lang.property listing')
@endsection

@section('content')
    <div class="popular_property" style="margin-top: 235px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-40 text-center">
                        <h3>@lang('lang.properties')</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="width: 90dvw;
        margin: auto;">
            <div class="table-responsive" style="width: 100%;
            overflow-y: overlay;">
                <table id="offerDataTable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr style="text-transform: capitalize">
                            <th>@lang('lang.title')</th>
                            <th>@lang('lang.property_id')</th>
                            <th>@lang('lang.contact_number')</th>
                            <th>@lang('lang.price')</th>
                            <th>@lang('lang.space')</th>
                            <th>@lang('lang.district')</th>
                            <th>@lang('lang.location')</th>
                            <th>@lang('lang.room')</th>
                            <th>@lang('lang.dev_name')</th>
                            <th>@lang('lang.ready_construction')</th>
                            <th>@lang('lang.property_type')</th>
                            <th>@lang('lang.roof')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#offerDataTable')) {

                fill_datatable(room = '', price = '', type = '', classification = '');

                function fill_datatable(room = '', price = '', type = '', classification = '') {
                    var dataTable = $('#offerDataTable').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        ajax: {
                            url: "{{ route('guest.get-offer', ['property_id' => $offerId]) }}",
                            data: {
                                room: room,
                                price: price,
                                type: type,
                                classification: classification
                            }
                        },
                        columns: [{
                                data: 'title',
                                name: 'title'
                            },
                            {
                                data: 'property_id',
                                name: 'property_id'
                            },
                            {
                                data: 'contact_number',
                                name: 'contact_number'
                            },
                            {
                                data: 'price',
                                name: 'price'
                            },
                            {
                                data: 'space',
                                name: 'space'
                            },
                            {
                                data: 'district',
                                name: 'district'
                            },
                            {
                                data: 'location',
                                name: 'location'
                            },
                            {
                                data: 'rooms',
                                name: 'rooms'
                            },
                            {
                                data: 'dev_name',
                                name: 'dev_name'
                            },
                            {
                                data: 'ready_construction',
                                name: 'ready_construction'
                            },
                            {
                                data: 'property_type',
                                name: 'property_type'
                            },
                            {
                                data: 'roof',
                                name: 'roof'
                            },
                        ]
                    });
                }

                $('#filter').click(function() {
                    var room = $('#room').val();
                    var price = $('#price').val();
                    var type = $('#type').val();
                    var classification = $('#classification').val();

                    $('#offerDataTable').DataTable().destroy();
                    fill_datatable(room, price, type, classification);

                });
            }
        });
    </script>
@endsection
