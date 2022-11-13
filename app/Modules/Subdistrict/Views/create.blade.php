{{ Form::open(['method' => 'POST', 'route' => ['subdistrict.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group">
        <label for="name">Nama Kelurahan</label>
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
    </div>
    <div class="form-group">
        <label for="district_id">Kecamatan</label>
        {{ Form::select('district_id', \Models\District::pluck('name', 'id')->all(), $district?$district->id:null, ['class' => 'form-control selectpicker', 'id' => 'district_id', 'data-live-search' => 'true', 'data-style' => 'btn-success']) }}
    </div>
</div>
{{ Form::close() }}
