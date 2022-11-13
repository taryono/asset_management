{{ Form::model($slider, ['method' => 'PUT','route' => ['slider.update', $slider->id],'class' => 'form-horizontal inline','enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group">
        <label for="title">Title</label>
        {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Judul', 'rows'=> 5, 'required']) }}
    </div>
    <div class="form-group">
        <label for="text">Text</label>
        {{ Form::textarea('text', null, ['class' => 'form-control', 'id' => 'text', 'placeholder' => 'Text']) }}             
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        {{ Form::select('status', [0=> 'Tidak Aktif', 1=> 'Aktif'], null, ['class' => 'form-control','id' => 'status','placeholder' => '--Pilih Status--', 'required']) }}                    
    </div>
    <div class="form-group">
        <label for="post_status_id">Status Publish</label>
        {{ Form::select('post_status_id', \Models\PostStatus::pluck('name', 'id')->all(), null, ['class' => 'form-control','id' => 'post_status_id','placeholder' => '--Pilih Status Publish--', 'required']) }}
    </div>
    <div class="form-group">
        <label for="publish_date">Tanggal Publish</label>
        {{ Form::date('publish_date', null, ['class' => 'form-control datepicker','id' => 'publish_date','placeholder' => 'Tanggal Publish','data-language' => 'en','data-multiple-tables' => 3,'data-multiple-tables-separator' => ',','data-position' => 'top left', 'required']) }}
    </div>
    <div class="form-group">
        <label for="image">Gambar</label><br>
        {{ Form::file('image', null, ['class' => 'form-control','id' => 'image','placeholder' => 'Upload Gambar', 'required']) }}
    </div>
</div>
{{ Form::close() }}
