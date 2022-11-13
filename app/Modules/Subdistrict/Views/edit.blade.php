{{ Form::model($subdistrict, ['method' => 'PUT', 'route' => ['subdistrict.update', $subdistrict->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group">
        <label for="name">Nama Kelurahan</label>
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
    </div>
    <div class="form-group">
        <label for="region_id">Kecamatan</label>
        {{ Form::select('district', \Models\District::pluck('name', 'id')->all(), null, ['class' => 'form-control selectpicker', 'id' => 'district', 'data-live-search' => 'true', 'data-style' => 'btn-success']) }}
    </div>
</div>
{{ Form::close() }}
