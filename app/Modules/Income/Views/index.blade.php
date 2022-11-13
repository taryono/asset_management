@extends('adminlte::page')  
@section('content') 
    <div id="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Pendapatan</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-income-tab" data-toggle="pill"
                                            href="#custom-tabs-one-income" role="tab" aria-controls="custom-tabs-one-income"
                                            aria-selected="true">Pendapatan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-income_type-tab" data-toggle="pill"
                                            href="#custom-tabs-one-income_type" role="tab" aria-controls="custom-tabs-one-income_type"
                                            aria-selected="true">Tipe Pendapatan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-income_category-tab" data-toggle="pill"
                                            href="#custom-tabs-one-income_category" role="tab" aria-controls="custom-tabs-one-income_category"
                                            aria-selected="true">Kategori Pendapatan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-from_type-tab" data-toggle="pill"
                                            href="#custom-tabs-one-from_type" role="tab" aria-controls="custom-tabs-one-from_type"
                                            aria-selected="true">Asal Pendapatan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-material_type-tab" data-toggle="pill"
                                            href="#custom-tabs-one-material_type" role="tab" aria-controls="custom-tabs-one-material_type"
                                            aria-selected="true">Jenis Pendapatan</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-income" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-income-tab"> 
                                        @include('Income::list')
                                    </div> 
                                    <div class="tab-pane fade show" id="custom-tabs-one-income_type" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-income_type-tab"> 
                                        @include('IncomeType::list')
                                    </div> 
                                    <div class="tab-pane fade show" id="custom-tabs-one-income_category" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-income_category-tab"> 
                                        @include('IncomeCategory::list')
                                    </div> 
                                    <div class="tab-pane fade show" id="custom-tabs-one-from_type" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-from_type-tab"> 
                                        @include('FromType::list')
                                    </div>
                                    <div class="tab-pane fade show" id="custom-tabs-one-material_type" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-material_type-tab"> 
                                        @include('MaterialType::list')
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    @push('js')
    <script>
        $(function() {
            $('.datepicker').datetimepicker({});
            $('.text-editor').summernote({
                height: 100,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['table', 'link', 'picture', 'video']],
                    ['Misc', ['codeview', 'fullscreen']]
                ],
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], editor, welEditable);
                },
                callbacks: {
                    onKeyup: function(e) {
                        var text = $('.note-editable').text();
                        $('.count').html(text.length);
                    },
                    onInit: function(e) {
                        var text = $('.note-editable').text();
                        $('.count').html(text.length);
                    }
                }
            });
        });
    </script>
@endpush
@endsection
