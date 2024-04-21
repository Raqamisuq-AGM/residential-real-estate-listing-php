@extends('layouts.dashboard.admin')
@section('title')
@lang('lang.all properties')
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@lang('lang.all properties')</h1>
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
                        {{-- <h3 class="card-title">@lang('lang.properties')</h3> --}}
                        <div>
                            <button class="btn btn-primary" id="toggleInput">@lang('lang.add property')</button>
                            @if (session()->has('searched'))
                            <a class="btn btn-primary" href="{{ route('admin.properties.all') }}">@lang('lang.all')</a>
                            @endif
                            <a class="btn btn-primary"
                                href="{{ route('admin.export-property') }}">@lang('lang.export')</a>
                        </div>
                        <div style="display: flex;">
                            <form method="GET" action="{{ route('admin.properties.search') }}" style="display: flex;">
                                {{-- @csrf --}}
                                <input type="text" name="query" class="form-control" placeholder="search property"
                                    required>
                                <button style="background: #0062cc;
                                width: 80px;
                                text-align: center;
                                color: #fff; border:none;">search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <form method="POST" action="{{ route('admin.properties.add.submit') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <table class="table table-hover text-nowrap table-sortable">
                                <thead>
                                    <tr>
                                        {{-- <th>SL</th> --}}
                                        <th>@lang('lang.offer id')</th>
                                        <th>@lang('lang.room')</th>
                                        <th>@lang('lang.space')</th>
                                        <th>@lang('lang.price')</th>
                                        <th>@lang('lang.district')</th>
                                        <th>@lang('lang.title')</th>
                                        <th>@lang('lang.contact number')</th>
                                        <th>@lang('lang.developer name')</th>
                                        <th>@lang('lang.location')</th>
                                        <th>@lang('lang.ready/construction')</th>
                                        <th>@lang('lang.type')</th>
                                        <th>@lang('lang.thumb')</th>
                                        {{-- <th>@lang('lang.roof')</th> --}}
                                        <th>@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="show-input" style="display: none;">
                                        <td><input type="text" disabled style="width: 100%"></td>
                                        <td><input type="text" class="form-control" id="room" name="rooms"
                                                placeholder="5" style="width: 100%"></td>
                                        <td><input type="text" class="form-control" id="space" name="space"
                                                placeholder="135" style="width: 100%"></td>
                                        <td><input type="text" class="form-control" id="price" name="price"
                                                placeholder="50" style="width: 100%"></td>

                                        <td><input type="text" class="form-control" id="district" name="district"
                                                placeholder="@lang('lang.district')" style="width: 100%"></td>
                                        <td><input type="text" type="text" class="form-control" id="title" name="title"
                                                placeholder="@lang('lang.title')" style="width: 100%">
                                        </td>
                                        <td><input type="text" class="form-control" id="contact_number"
                                                name="contact_number" placeholder="002658745" style="width: 100%"></td>

                                        <td><input type="text" class="form-control" id="dev_name" name="dev_name"
                                                placeholder="jon doe" style="width: 100%"></td>
                                        <td><input type="text" class="form-control" id="location" name="location"
                                                placeholder="@lang('lang.location')" style="width: 100%"></td>
                                        <td>
                                            <select class="form-control" style="width: 100%;" name="ready_construction">
                                                <option value="Ready">@lang('lang.ready')</option>
                                                <option value="Under Contruction">@lang('lang.under construction')
                                                </option>
                                            </select>
                                        </td>
                                        <td style="width: 10%">
                                            <select class="form-control" style="width: 100%;" name="property_type">
                                                <option value="Apartment">@lang('lang.apartment')</option>
                                                <option value="Villa">@lang('lang.villa')</option>
                                                <option value="Land">@lang('lang.land')</option>
                                                <option value="Roof">@lang('lang.roof')</option>
                                            </select>
                                        </td>
                                        {{-- <td style="width: 6%">
                                            <select class="form-control" style="width: 100%;" name="roof">
                                                <option value="yes">@lang('lang.yes')</option>
                                                <option value="no">@lang('lang.no')</option>

                                            </select>
                                        </td> --}}
                                        <td>
                                            <input type="file" name="thumb[]" style="width: 100%" multiple="multiple"
                                                accept="jpg,jpeg,png,gif,webp">
                                        </td>
                                        <td>
                                            <button style="margin-right: 15px; color: #0c4b36;border: none;
                                                background: transparent;" type="submit">
                                                <i class="fas fa-check" aria-hidden="true"></i>
                                            </button>
                                            <a id="hideInput" href="#" style="color: #0c4b36">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @forelse ($properties as $property)
                                    <tr>
                                        {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                        <td>{{ $property->property_id }}</td>
                                        <td>{{ $property->rooms }}</td>
                                        <td>{{ $property->space }}</td>
                                        <td>SAR {{ $property->price }}</td>
                                        <td>{{ $property->district }}</td>
                                        <td>{{ $property->title }}</td>
                                        <td>{{ $property->contact_number }}</td>
                                        <td>{{ $property->dev_name }}</td>
                                        <td>
                                            <a href="{{ $property->location }}" target="_blank">
                                                Location
                                            </a>
                                        </td>
                                        <td>{{ $property->ready_construction }}</td>
                                        <td>{{ $property->property_type }}</td>
                                        {{-- <td>{{ $property->roof }}</td> --}}
                                        <td>
                                            @if ($property->images->isNotEmpty())
                                            @foreach ($property->images as $img)
                                            <a href="{{ asset('assets/image/property/' . $img->img) }}"
                                                class="gallerys prop-imgs">
                                                <img src="{{ asset('assets/image/property/' . $img->img) }}"
                                                    alt="Property Image" style="width: 50px;">
                                            </a>
                                            @endforeach
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('offer-details', ['offer_id' => $property->property_id]) }}"
                                                target="_blank" style="margin-right: 15px; color: #0c4b36">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="#" id="copyLink{{ $property->id }}" class="copy-link"
                                                data-url="{{ request()->getSchemeAndHttpHost() . '/offer-details' . '/' . $property->property_id }}"
                                                style="margin-right: 15px; color: #0c4b36">
                                                <i class="fa fa-clone" aria-hidden="true"></i>
                                            </a>
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
                                        <td colspan="15" class="text-center">@lang('lang.no properties found')</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Check if there is pagination data -->
                            @if ($properties->lastPage() > 1)
                            <!-- Render pagination with page numbers -->
                            <div class="pagination-wrap mt-40">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination list-wrap" style="float: right;">
                                        <!-- Previous Page Link -->
                                        @if ($properties->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link">@lang('lang.previous')</span>
                                        </li>
                                        @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $properties->previousPageUrl() }}"
                                                rel="prev">@lang('lang.previous')</a>
                                        </li>
                                        @endif

                                        <!-- Page links -->
                                        @foreach ($properties->getUrlRange(1, $properties->lastPage()) as $page => $url)
                                        @if ($page == $properties->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                        @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                        @endif
                                        @endforeach

                                        <!-- Next Page Link -->
                                        @if ($properties->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $properties->nextPageUrl() }}"
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

    .table-sortable th {
        cursor: pointer;
    }

    .table-sortable .th-sort-asc::after {
        content: "\25b4";
    }

    .table-sortable .th-sort-desc::after {
        content: "\25be";
    }

    .table-sortable .th-sort-asc::after,
    .table-sortable .th-sort-desc::after {
        margin-left: 5px;
    }

    .table-sortable .th-sort-asc,
    .table-sortable .th-sort-desc {
        background: rgba(0, 0, 0, 0.1);
    }

    .prop-imgs {
        display: none;
    }

    .prop-imgs:first-child {
        display: block;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
    integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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

<script>
    // JavaScript function to copy URL to clipboard
        function copyToClipboard(text) {
            var input = document.createElement('textarea');
            input.innerHTML = text;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
        }

        // Get all elements with the class 'copy-link' and attach event listener
        document.querySelectorAll('.copy-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var url = this.dataset.url; // Get the URL from data-url attribute
                copyToClipboard(url); // Copy the URL to clipboard

                // Display a success message (you can replace this with a toast notification or any other UI element)
                alert('URL copied to clipboard');
            });
        });
</script>

<script>
    /**
         * Sorts a HTML table.
         *
         * @param {HTMLTableElement} table The table to sort
         * @param {number} column The index of the column to sort
         * @param {boolean} asc Determines if the sorting will be in ascending
         */
        function sortTableByColumn(table, column, asc = true) {
            const dirModifier = asc ? 1 : -1;
            const tBody = table.tBodies[0];
            const rows = Array.from(tBody.querySelectorAll("tr"));

            // Sort each row
            const sortedRows = rows.sort((a, b) => {
                const aColText = a.querySelector(`td:nth-child(${column + 1})`).textContent.trim();
                const bColText = b.querySelector(`td:nth-child(${column + 1})`).textContent.trim();

                return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
            });

            // Remove all existing TRs from the table
            while (tBody.firstChild) {
                tBody.removeChild(tBody.firstChild);
            }

            // Re-add the newly sorted rows
            tBody.append(...sortedRows);

            // Remember how the column is currently sorted
            table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
            table.querySelector(`th:nth-child(${column + 1})`).classList.toggle("th-sort-asc", asc);
            table.querySelector(`th:nth-child(${column + 1})`).classList.toggle("th-sort-desc", !asc);
        }

        document.querySelectorAll(".table-sortable th").forEach(headerCell => {
            headerCell.addEventListener("click", () => {
                const tableElement = headerCell.parentElement.parentElement.parentElement;
                const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children,
                    headerCell);
                const currentIsAscending = headerCell.classList.contains("th-sort-asc");

                sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
            });
        });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
    integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
            $('.gallerys').magnificPopup({
                type: 'image',
                // delegate: 'a',
                gallery: {
                    enabled: true
                },
            });
        });
</script>
@endsection