@extends('adminlte::page')
@section('content')

    <div id="container">
        {{ Form::model($assignment, ['method' => 'PUT', 'route' => ['assignment.update', $assignment->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
        <div class="card" style="margin-top: 10px;">
            <div class="card-header">
                <div class="card-title">
                    <h1>Edit SK Pengurus</h1>
                </div>
                <div style="float: right">
                    {!! submit(['style' => 'float:right;margin-right: 5px;']) !!}
                    {!! kembali(['url' => '/management/structure', 'style' => 'float:right;margin-right: 5px;', 'title' => 'Batal']) !!}
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="name">Judul SK</label>
                                {{ Form::text('name', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-8">
                                <label for="structure_id">Kepengurusan</label>
                                {{ Form::select('structure_id', \Models\Structure::pluck('name', 'id')->all(), null, ['class' => 'form-control selectpicker']) }}
                            </div>
                            <div class="col-md-4">
                                <label for="position_id">Seksi/Bagian</label>
                                {{ Form::select('position_id',\Models\Position::whereNotIn('id', [1, 13])->pluck('name', 'id')->all(),null,['class' => 'form-control selectpicker']) }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="employee_id">Dijabat Oleh</label>
                                {{ Form::select('employee_id', \Models\Employee::pluck('name', 'id')->all(), null, ['class' => 'form-control selectpicker']) }}
                            </div>
                            <div class="col-md-6">
                                <label for="sign_by">Ditandatangani Oleh</label>
                                {{ Form::text('sign_by', null, ['class' => 'form-control']) }}
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="start_date">Masa Berlaku SK dari Tanggal</label>
                                {{ Form::date('start_date', null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-6">
                                <label for="end_date">Sampai Tanggal</label>
                                {{ Form::date('end_date', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="date">Tanggal Pembuatan SK</label>
                                {{ Form::date('date', null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-6">
                                <label for="code">No SK</label>
                                {{ Form::text('code', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="content">Kontent</label>
                                {{ Form::textarea('content', old('content'), ['class' => 'form-control text-editor', 'id' => 'content', 'placeholder' => 'Content', 'rows' => '1000']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12">

                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    @push('js')
        <script>
            $(function() {
                $('.datepicker').datetimepicker({
                    years: function(a) {
                        console.log(this)
                    }
                });
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
@stop
