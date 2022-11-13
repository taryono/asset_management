@extends('adminlte::page')
@section('content')
    <div id="container">
        {{ Form::model($post, ['method' => 'PUT', 'route' => ['post.update', $post->id], 'class' => 'form-horizontal inline', 'enctype' => 'multipart/form-data']) }}
        <div class="card" style="margin-top: 10px;">
            <div class="card-header">
                <div class="card-title">
                    <h1>Edit Postingan</h1>
                </div>
                <div style="float: right">
                    {!! submit(['style' => 'float:right;margin-right: 5px;margin-left: 5px;']) !!}
                    {!! kembali(['url' => route('management.post'), 'style' => 'float:right;margin-right: 5px;margin-left: 5px;']) !!}
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="title">Title</label>
                            {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Judul', 'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            {{ Form::select('category_id', \Models\Category::pluck('name', 'id')->all(), null, ['class' => 'form-control', 'id' => 'category_id', 'placeholder' => '--Pilih Kategori--', 'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="post_status_id">Status</label>
                            {{ Form::select('post_status_id', \Models\PostStatus::pluck('name', 'id')->all(), null, ['class' => 'form-control', 'id' => 'post_status_id', 'placeholder' => '--Pilih Status Publish--', 'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="publish_date">Tanggal Publish</label>
                            {{ Form::date('publish_date', $post->publish_date, ['class' => 'form-control datepicker', 'id' => 'publish_date', 'placeholder' => 'Tanggal Publish', 'data-language' => 'en', 'data-multiple-tables' => 3, 'data-multiple-tables-separator' => ',', 'data-position' => 'top left', 'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="meta">Meta</label>
                            {{ Form::text('meta', null, ['class' => 'form-control', 'id' => 'meta', 'placeholder' => 'Meta Blog', 'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            {{ Form::text('author', null, ['class' => 'form-control', 'id' => 'author', 'placeholder' => 'Pengarang', 'required']) }}
                        </div> 
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="content">Content</label>
                            {{ Form::textarea('content', null, ['class' => 'form-control text-editor', 'id' => 'content', 'placeholder' => 'Content', 'rows' => '1000']) }}
                        </div>
                        <div class="form-group">
                            <label for="written_by">Penulis</label>
                            {{ Form::text('written_by', $user->name, ['class' => 'form-control', 'id' => 'written_by', 'placeholder' => 'Penulis', 'readonly' => 'readonly']) }}
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
@stop
