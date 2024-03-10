@extends('layouts.dashboard.admin')
@section('title')
    @lang('lang.add') @lang('lang.properties')
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
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.add') @lang('lang.properties')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('admin.properties.add.submit') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">@lang('lang.title')</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="@lang('lang.title')" required />
                                </div>
                                <div class="form-group">
                                    <label for="room">@lang('lang.room')</label>
                                    <input type="text" class="form-control" id="room" name="rooms" placeholder="5"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="district">@lang('lang.location')</label>
                                    <input type="text" class="form-control" id="district" name="district"
                                        placeholder="@lang('lang.location')" required />
                                </div>
                                <div class="form-group">
                                    <label for="price">@lang('lang.price')</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        placeholder="50" required />
                                </div>
                                <div class="form-group">
                                    <label for="dev_name">@lang('lang.developer name')</label>
                                    <input type="text" class="form-control" id="dev_name" name="dev_name"
                                        placeholder="jon doe" required />
                                </div>
                                <div class="form-group">
                                    <label for="contact_number">@lang('lang.contact number')</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number"
                                        placeholder="002658745" required />
                                </div>
                                <div class="form-group">
                                    <label for="property_type">@lang('lang.property type')</label>
                                    <select class="form-control" style="width: 100%;" name="property_type" required>
                                        <option value="Appartment">@lang('lang.apartment')</option>
                                        <option value="Villa">@lang('lang.villa')</option>
                                        <option value="Land">@lang('lang.land')</option>
                                        <option value="Roof">@lang('lang.roof')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="type">@lang('lang.ready/construction')</label>
                                    <select class="form-control" style="width: 100%;" name="ready_construction" required>
                                        <option value="Ready">@lang('lang.ready')</option>
                                        <option value="Under Contruction">@lang('lang.under construction')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="space">@lang('lang.space')</label>
                                    <input type="text" class="form-control" id="space" name="space"
                                        placeholder="135" required />
                                </div>
                                <div class="form-group">
                                    <label for="thumb">@lang('lang.images')</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="thumb" name="thumb[]"
                                                multiple="multiple" accept="jpg,jpeg,png,gif,webp" />
                                            <label class="custom-file-label" for="thumb">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@lang('lang.description')</label>
                                    <textarea id="summernote" name="description"></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('lang.submit')</button>
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
    <!-- /.content -->
@endsection

@section('script')
    <!-- jQuery -->
    <script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dashboard/dist/js/adminlte.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('dashboard/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('dashboard/plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dashboard/dist/js/demo.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
